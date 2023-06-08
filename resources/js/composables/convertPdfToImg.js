import { router } from "@inertiajs/vue3";
import { getDocument, GlobalWorkerOptions } from "pdfjs-dist";
GlobalWorkerOptions.workerSrc = import("pdfjs-dist/build/pdf.worker.entry");

export default async function convertPdfToImg(file) {
    const reader = new FileReader();
    reader.onloadstart = (evt) => {
        document.querySelector("#upload-text").innerHTML = `
        <h1 class="mb-1">Uploading...</h1>
        <p>${file.name}</p>
        <p class="py-1.5 hover:bg-slate-100 hover:shadow-md duration-300 px-2 bg-white rounded text-sm shadow-xl mt-3 flex items-center gap-1 justify-center">Cancel</p>
    `;
    };
    reader.readAsArrayBuffer(file);

    await new Promise((resolve) => {
        reader.onload = resolve;
    });

    const arrayBuffer = reader.result;

    const loadingTask = getDocument(arrayBuffer);
    const pdf = await loadingTask.promise;

    const numPages = pdf.numPages;
    let imageDataList = [];

    for (let pageNumber = 1; pageNumber <= numPages; pageNumber++) {
        const page = await pdf.getPage(pageNumber);
        const viewport = page.getViewport({ scale: 1.0 });
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderTask = page.render({
            canvasContext: context,
            viewport: viewport,
        });

        await renderTask.promise;

        const imageDataURL = canvas.toDataURL();
        imageDataList.push(imageDataURL);
    }

    reader.onprogress = () => {
        setTimeout(() => {
            document.querySelector("#upload-text").innerHTML = `
        <h1 class="mb-1">Progress...</h1>
        <p>${file.name}</p>
    `;
        }, 2000);
    };
    return imageDataList;
}

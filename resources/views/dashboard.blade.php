<x-layout.app>
    <div>

        <aside
            class="aside fixed z-20 transition-all md:ml-[0%] ml-[-100%] top-0 pb-3 px-6 w-[60%] sm:w-[35%] md:w-[25%] flex flex-col justify-between h-screen border-r bg-slate-800 duration-500  lg:w-[18%] xl:w-[18%] 2xl:w-[15%]">
            <div class="mt-3">
                <div class="flex justify-between items-center">
                    <p class="text-green-500 text-2xl md:text-3xl font-bold">
                        E-Signature
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        onclick="asideToggle()" stroke="currentColor"
                        class="w-6 h-6 text-green-500 cursor-pointer  md:hidden">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>

                <ul class="mt-7 space-y-2">
                    <x-aside-link title="Dashboard" go="dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18"
                            height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                            <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                            <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                            <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                        </svg>
                    </x-aside-link>

                    <x-aside-link title="Approvement" go="user.approvement">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon icon-tabler icon-tabler-code" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </x-aside-link>

                    <x-aside-link title="Signature" go="signature.index">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon icon-tabler icon-tabler-code" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </x-aside-link>

                    <x-aside-link title="Input" go="dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon icon-tabler icon-tabler-code" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3" />
                        </svg>
                    </x-aside-link>

                    <x-aside-link title="Send" go="send-document.index">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon icon-tabler icon-tabler-code" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </x-aside-link>

                    <x-aside-link title="Documents" go="document.index">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon icon-tabler icon-tabler-code" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </x-aside-link>
                </ul>
            </div>
        </aside>

        <div class="ml-auto h-screen lg:w-[82%] xl:w-[82%] 2xl:w-[85%] relative bg-gray-100">
            <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
                <div class="px-6 flex items-center justify-between space-x-4 2xl:container">
                    <h5 hidden class="text-2xl font-medium lg:block">
                        Dashboard
                    </h5>
                    <button onclick="asideToggle()" class="w-12 h-16 -mr-2 border-r lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="flex space-x-4">
                        <!--search bar -->
                        <div hidden class="md:block">
                            <div class="relative flex items-center text-gray-400 focus-within:text-green-400">
                                <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
                                    <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 fill-current"
                                        viewBox="0 0 35.997 36.004">
                                        <path id="Icon_awesome-search" data-name="search"
                                            d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z">
                                        </path>
                                    </svg>
                                </span>
                                <input type="search" name="leadingIcon" id="leadingIcon" placeholder="Search here"
                                    class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none hover:border-green-500 focus:ring-green-500 border border-gray-300 focus:border-green-300 transition" />
                            </div>
                        </div>
                        <!--/search bar -->
                        <button aria-label="search"
                            class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200 md:hidden">
                            <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 mx-auto fill-current text-gray-600"
                                viewBox="0 0 35.997 36.004">
                                <path id="Icon_awesome-search" data-name="search"
                                    d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z">
                                </path>
                            </svg>
                        </button>

                        <div>
                            <div class="flex items-center gap-x-2 cursor-pointer">
                                <img class="object-cover w-9 h-9 rounded-full" data-dropdown-toggle="dropdown"
                                    src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
                                    alt="" />
                            </div>

                            <div id="dropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-32 dark:bg-gray-700">
                                <ul class="text-sm text-gray-700 dark:text-gray-200">
                                    <li class="block py-2 hover:bg-green-100 cursor-pointer">
                                        <div class="gap-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>

                                            <Link :href="route('profile.edit')" class="text-green-500">Profile</Link>
                                        </div>
                                    </li>
                                    <li class="block py-2 hover:bg-green-100 cursor-pointer">
                                        <div class="gap-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                            </svg>

                                            <p click="logout" class="text-green-500">Logout</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sm:px-6 sm:pt-6 flex flex-col 2xl:container select-none">
                <div class="p-3 shadow py-5 rounded">
                    <div class="sm:flex gap-3 flex-col w-full md:flex-row  justify-around">
                        <div
                            class=" w-full sm:w-1/2 flex justify-center items-center p-3 py-5 mb-3 sm:mb-0 rounded shadow-md bg-white">
                            <canvas id="polarArea"></canvas>
                        </div>
                        <div
                            class=" w-full sm:w-1/2 flex justify-center items-center p-3 py-5 mb-3 sm:mb-0 rounded shadow-md bg-white">
                            <canvas id="line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js">
    </script>
    <script>
        (async function() {
            const data = [
                { year: 2010, count: 10 },
                { year: 2011, count: 20 },
                { year: 2012, count: 15 },
                { year: 2013, count: 25 },
                { year: 2014, count: 22 },
                { year: 2015, count: 30 },
                { year: 2016, count: 28 },
            ];

            new Chart(
            document.getElementById('polarArea'),
                {
                    type: 'polarArea',
                    data: {
                        labels: data.map(row => row.year),
                        datasets: [
                            {
                                label: 'Documents by year',
                                data: data.map(row => row.count),
                                backgroundColor: [
                                    "rgb(255, 99, 132)",
                                    "rgb(75, 192, 192)",
                                    "rgb(255, 205, 86)",
                                    "rgb(0, 255, 187)",
                                    "rgb(19, 255, 2)",
                                ],
                            }
                        ],
                    },
                    options: {
                        responsive: true,
                    },
                }
            );

            new Chart(
            document.getElementById('line'),
                {
                    type: 'bar',
                    data: {
                        labels: data.map(row => row.year),
                        datasets: [
                            {
                                label: 'Documents by year',
                                data: data.map(row => row.count),
                                backgroundColor: [
                                    "rgb(255, 99, 132)",
                                    "rgb(75, 192, 192)",
                                    "rgb(255, 205, 86)",
                                    "rgb(0, 255, 187)",
                                    "rgb(19, 255, 2)",
                                ],
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                    },
                }
            );
        })();

    function asideToggle(){
    console.log(new Chart());
    const aside = document.querySelector(".aside")
    if(aside.classList.contains("ml-[-100%]")){
    aside.classList.remove("ml-[-100%]")
    }else{
    aside.classList.add("ml-[-100%]")
    }
    }
    </script>
</x-layout.app>
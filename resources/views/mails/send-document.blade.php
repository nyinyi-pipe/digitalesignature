<x-mail::message>
    <div class="main-container">
        <div class="container">
            <div class="company-name">
                <img src="https://images.pexels.com/photos/325044/pexels-photo-325044.jpeg?cs=srgb&dl=pexels-chevanon-photography-325044.jpg&fm=jpg"
                    alt="">
                <h2>E-signature</h2>
            </div>
            <div class="content-container">
                <div class="sender-main">
                    <img class="sender-img"
                        src="https://images.pexels.com/photos/325044/pexels-photo-325044.jpeg?cs=srgb&dl=pexels-chevanon-photography-325044.jpg&fm=jpg"
                        alt="">
                    <div class="sender-container">
                        <h4>{{auth()->user()->name}}</h4>
                        <span>sent you</span>
                        <h4>{{$subject}}</h4>
                    </div>
                </div>
                <p class="content">
                    {{$message}}
                </p>
                <div class="button-container">
                    <a type="button" target="_blank" href="{{$link}}" class="open-document">OPEN THE DOCUMENT</a>
                    <button>FORWARD</button>
                </div>
            </div>
            <div class="footer-container">
                <p class="footer">Use PandaDoc to create, send, track, and eSign documents — quickly and securely.</p>
            </div>
        </div>
    </div>
</x-mail::message>

@component('mail::message')
<h1>Hi, {{$details['name']}}</h1> 
{{ $details['body'] }}


{{-- To learn more, please click the button below.   

@component('mail::button', ['url' => 'https://medexamcenter.com/a/pf_preview?id=20132b37-e88f-46da-975b-6d41411ecb55'])
    Click Me!
@endcomponent --}}

@component('mail::button', ['url' => 'https://www.medexamcenter.com'])
    Visit our Website!
@endcomponent


<div class="contact">
    <p class="sm">NEAC Medical Exams Application Center
    2F St. Thomas Square 1150 Corner P. Campa Street Espana Blvd.Sampaloc
    1008 Manila</p>
    <div class="socmed">
        <a href="https://facebook.com"><img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Facebook_colored_svg_copy-512.png" class="logo" alt="Facebook Logo" style="height:35px; width:35px; margin-right:10px;" ></a>
        <a href="https://twitter.com"><img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Twitter_colored_svg-512.png" class="logo" alt="Twitter Logo" style="height:35px; width:35px; margin-right:10px;" ></a>
        <a href="https://linkedin.com"><img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Linkedin_unofficial_colored_svg-512.png" class="logo" alt="LinkedIn Logo" style="height:35px; width:35px; margin-right:10px;" ></a>
        <a href="https://instagram.com"><img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Instagram_colored_svg_1-512.png" class="logo" alt="IG Logo" style="height:35px; width:35px;" ></a>
    </div>
        {{-- <a href="https://twitter.com" class="fa fa-twitter"></a>
        <a href="https://linkedin.com" class="fa fa-linkedin"></a>
        <a href="https://instagram.com" class="fa fa-instagram"></a> --}}
  
</div> 

<br>

@endcomponent
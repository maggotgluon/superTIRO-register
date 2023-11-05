<x-base-layout>
    <a href="/">
        <x-application-logo class="h-20 fill-current text-gray-500" />
    </a>
    <div class="container grid md:grid-cols-2 mt-4">
        <div>
            <img class="m-auto" src="{{asset('landing_banner.jpg')}}">
        </div>
        <div class="bg-content-dark/20 p-4 grid place-content-center">
            โปรแกรมปกป้องสุนัขจากปรสิตตัวร้ายที่สัตวแพทย์แนะนำเป็นประจำทุกเดือน 
            ซึ่งถูกออกแบบมาเพื่อสุนัขโดยเฉพาะ เพื่อคนรักสุนัขยุคใหม่ กับ “พลังปกป้องถึง 3 ชั้น” ได้แก่ พยาธิหนอนหัวใจ, หมัด-เห็บ, พยาธิทางเดินอาหาร
            ปกป้องน้องหมาจากปรสิตร้ายที่อันตรายถึงชีวิตไปกับ Super TRIO
        </div>
    </div>

    <main class="container m-auto py-16 px-2">
        <livewire:client-register />
    </main>
    <div class="container grid md:grid-cols-2 mt-4">
        <div class="bg-content-dark/20 flex">
            <iframe src="https://www.youtube.com/embed/4WHGfONNDM4?si=O32zKrvy87v97Rgd" 
            class="w-full h-auto aspect-video"
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen></iframe>
        </div>
        <div class="bg-content-dark/20 grid place-content-center">
            <div class="grid md:grid-cols-3 p-2 gap-2">
                <div class="bg-white rounded-xl overflow-hidden drop-shadow-sm">
                    <img src="{{asset('a1.jpg')}}">
                    <span class="bg-primary-blue ml-2 p-1 px-2 text-xs font-thin text-secondary-100 block w-max">เคล็ดลับปกป้อง</span>
                    <h3 class="text-md font-bold p-1 truncate overflow-clip"><a href="https://www.supertriodog.com/%e0%b8%9e%e0%b8%a2%e0%b8%b2%e0%b8%98%e0%b8%b4%e0%b8%ab%e0%b8%99%e0%b8%ad%e0%b8%99%e0%b8%ab%e0%b8%b1%e0%b8%a7%e0%b9%83%e0%b8%88/">“พยาธิหนอนหัวใจ”</a></h3>
                    <p class="p-1 text-sm line-clamp-3 pb-0 overflow-hidden text-ellipsis">
                        ปรสิตตัวร้ายที่สัตวแพทย์เตือนนัก เตือนหนาว่ามีความอันตรายร้ายแรง แถมยังติดง่ายเพียงการโดนยุงกัดแค่ครั้งเดียว อันตรายจากพยาธิหนอนหัวใจจะมากมายแค่ไหนกันนะ ? ไปหาคำตอบพร้อมกันได้เลย !
                    </p>
                    <a class="block py-2 text-center" href="https://www.supertriodog.com/%e0%b8%9e%e0%b8%a2%e0%b8%b2%e0%b8%98%e0%b8%b4%e0%b8%ab%e0%b8%99%e0%b8%ad%e0%b8%99%e0%b8%ab%e0%b8%b1%e0%b8%a7%e0%b9%83%e0%b8%88/">อ่านต่อ</a>
                </div>
                <div class="bg-white rounded-xl overflow-hidden drop-shadow-sm">
                    <img src="{{asset('a2.jpg')}}">
                    <span class="bg-primary-blue ml-2 p-1 px-2 text-xs font-thin text-secondary-100 block w-max">เคล็ดลับปกป้อง</span>
                    <h3 class="text-md font-bold p-1 truncate overflow-clip"><a href="https://www.supertriodog.com/%e0%b9%80%e0%b8%ab%e0%b9%87%e0%b8%9a%e0%b8%81%e0%b8%b1%e0%b8%94%e0%b8%a3%e0%b8%b0%e0%b8%a7%e0%b8%b1%e0%b8%87%e0%b8%9e%e0%b8%a2%e0%b8%b2%e0%b8%98%e0%b8%b4%e0%b9%80%e0%b8%a1%e0%b9%87%e0%b8%94%e0%b9%80/">เห็บกัดระวังพยาธิเม็ดเลือด !</a></h3>
                    <p class="p-1 text-sm line-clamp-3 pb-0 overflow-hidden text-ellipsis">
                        โรคร้ายที่แฝงมากับเห็บ ปล่อยไว้อันตรายถึงชีวิต ! รู้หรือไม่ !? เห็บกัดไม่ใช่แค่คัน แต่ยังนำโรคร้ายอย่าง “โรคพยาธิเม็ดเลือด” มาสู่น้องหมาได้อีกด้วย ! 😱
                    </p>
                    <a class="block py-2 text-center" href="https://www.supertriodog.com/%e0%b9%80%e0%b8%ab%e0%b9%87%e0%b8%9a%e0%b8%81%e0%b8%b1%e0%b8%94%e0%b8%a3%e0%b8%b0%e0%b8%a7%e0%b8%b1%e0%b8%87%e0%b8%9e%e0%b8%a2%e0%b8%b2%e0%b8%98%e0%b8%b4%e0%b9%80%e0%b8%a1%e0%b9%87%e0%b8%94%e0%b9%80/">อ่านต่อ</a>
                </div>
                <div class="bg-white rounded-xl overflow-hidden drop-shadow-sm">
                    <img src="{{asset('a3.jpg')}}">
                    <span class="bg-primary-blue ml-2 p-1 px-2 text-xs font-thin text-secondary-100 block w-max">เคล็ดลับปกป้อง</span>
                    <h3 class="text-md font-bold p-1 truncate overflow-clip"><a href="https://www.supertriodog.com/%e0%b9%80%e0%b8%9c%e0%b8%a2-3-%e0%b9%80%e0%b8%ab%e0%b8%95%e0%b8%b8%e0%b8%9c%e0%b8%a5%e0%b8%88%e0%b8%b2%e0%b8%81%e0%b8%9c%e0%b8%b9%e0%b9%89%e0%b8%a3%e0%b8%b9%e0%b9%89%e0%b8%88%e0%b8%a3%e0%b8%b4/">เผย 3 เหตุผลจากผู้รู้จริง ! ทำไมปกป้องน้องหมาจากปรสิตร้ายทั้งทีต้องเสริมเกราะป้องกันถึง 3 ชั้น ?</a></h3>
                    <p class="p-1 text-sm line-clamp-3 pb-0 overflow-hidden text-ellipsis">
                        พยาธิหนอนหัวใจ ปรสิตร้ายที่มียุงเป็นพาหะ เพียงการโดนยุงกัด “แค่ครั้งเดียว” ก็สามารถทำให้น้องหมาติดพยาธิหนอนหัวใจได้ การปกป้องพยาธิหนอนหัวใจในน้องหมาเป็นอีกหนึ่งการปกป้องที่สัตวแพทย์แนะนำให้เจ้าของทำอย่างต่อเนื่อง และห้ามละเลยโดยเด็ดขาด !
                    </p>
                    <a class="block py-2 text-center" href="https://www.supertriodog.com/%e0%b9%80%e0%b8%9c%e0%b8%a2-3-%e0%b9%80%e0%b8%ab%e0%b8%95%e0%b8%b8%e0%b8%9c%e0%b8%a5%e0%b8%88%e0%b8%b2%e0%b8%81%e0%b8%9c%e0%b8%b9%e0%b9%89%e0%b8%a3%e0%b8%b9%e0%b9%89%e0%b8%88%e0%b8%a3%e0%b8%b4/">อ่านต่อ</a>
                </div>
            </div>
            <a href="https://www.supertriodog.com/wp-content/uploads/2023/01/Super-Trio-Brochure.pdf"
            class="bg-primary-blue rounded-md drop-shadow-sm text-secondary-50 text-center p-2 m-4">กดที่นี่เพื่อ Download คู่มือโปรแกรมปกป้องสุนัขจากปรสิตร้าย</a>
        </div>
        
    </div>
    <footer class="text-white w-full pt-16">
        <div class="m-auto">
            <img class="max-w-xl w-full -mb-10 mx-auto" src="{{asset('footer_banner.png')}}">
        </div>
        <div class="bg-primary-blue w-full rounded-t-3xl py-8">
            <section class="container grid md:grid-cols-3 m-auto pt-8 gap-8 text-center md:text-left">
                <div>
                    <x-application-logo class="w-32 m-auto my-4" />
                    <p class="text-center">ลงทะเบียนเพื่อรับข่าวสาร คำแนะนำ และเคล็ดลับด้านสุขภาพของสุนัข</p>
                    <a href="https://www.supertriodog.com">
                    <div class="flex px-4 py-2">
                        <input type="text" autocomplete="off" 
                            class="placeholder-secondary-400 
                                border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 
                                form-input block w-full sm:text-sm 
                                transition ease-in-out duration-100 focus:outline-none shadow-sm rounded-l-lg">
                    
                        <button type="button" 
                            class="outline-none inline-flex justify-center items-center group transition-all ease-in duration-150 
                                focus:ring-2 focus:ring-offset-2 hover:shadow-sm 
                                disabled:opacity-80 disabled:cursor-not-allowed rounded-r-lg gap-x-2 text-sm px-4 py-2     
                                bg-secondary-red
                                border border-secondary-red text-black hover:bg-secondary-red/75 ring-secondary-red/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                        </button>
                    </div>
                </a>
                </div> 
                <div>
                    <b class="mb-4 block">SITE MAP</b>
                    <ul>
                        <li><a href="https://www.supertriodog.com" class="hover:text-secondary-red">หน้าหลัก</a></li>
                        <li><a href="https://www.supertriodog.com/what-is-super-trio/" class="hover:text-secondary-red">Super TRIO คืออะไร ?</a></li>
                        <li><a href="https://www.supertriodog.com/why-protection/" class="hover:text-secondary-red">ทำไมต้องป้องกัน</a></li>
                        <li><a href="https://www.supertriodog.com/tip/" class="hover:text-secondary-red">เคล็ดลับปกป้อง</a></li>
                        <li><a href="https://www.supertriodog.com/contact-us/" class="hover:text-secondary-red">ติดต่อเราให้อุ่นใจ</a></li>
                    </ul>
                </div>
                <div>
                    <b class="mb-4 block">แค่ติดตามก็อุ่นใจ</b>
                    <ul>
                        <li><a href="https://line.me/ti/p/%40PetsSociety">
                            <svg class="fill-white inline-block mb-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 50 50">
                                <path fill="#ffffff" d="M9 4C6.24 4 4 6.24 4 9v32c0 2.76 2.24 5 5 5h32c2.76 0 5-2.24 5-5V9c0-2.76-2.24-5-5-5H9Zm16 7c8.27 0 15 5.35 15 11.94 0 2.63-1.05 5.01-3.23 7.35 -1.57 1.78-4.12 3.73-6.47 5.35 -2.35 1.6-4.52 2.85-5.32 3.18 -.32.13-.56.18-.75.18 -.66 0-.61-.7-.56-.99 .04-.22.22-1.27.22-1.27 .05-.37.09-.96-.06-1.33 -.17-.41-.85-.63-1.34-.73 -7.2-.94-12.54-5.9-12.54-11.8 0-6.59 6.73-11.95 15-11.95Zm-1.01 7.99c-.51 0-1 .39-1 1v6c0 .55.44 1 1 1 .55 0 1-.45 1-1v-2.88l2.18 3.45c.56.79 1.81.39 1.81-.59v-6c0-.56-.45-1-1-1 -.56 0-1 .44-1 1v3l-2.19-3.59c-.22-.3-.52-.43-.83-.43Zm-9 0c-.56 0-1 .44-1 1v6c0 .55.44 1 1 1h3c.55 0 1-.45 1-1 0-.56-.45-1-1-1h-2v-5c0-.56-.45-1-1-1Zm6 0c-.56 0-1 .44-1 1v6c0 .55.44 1 1 1 .55 0 1-.45 1-1v-6c0-.56-.45-1-1-1Zm10 0c-.56 0-1 .44-1 1v6c0 .55.44 1 1 1h3c.55 0 1-.45 1-1 0-.56-.45-1-1-1h-2v-1h2c.55 0 1-.45 1-1 0-.56-.45-1-1-1h-2v-1h2c.55 0 1-.45 1-1 0-.56-.45-1-1-1h-3Z"/>
                              </svg>
                            @PetsSociety</a>
                        <li><a href="https://facebook.com/PetsSocietybyZoetis">
                            <svg class="fill-white inline-block mb-1" width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path fill="#ffffff" d="M12 2C6.5 2 2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.3v7C18.3 21.1 22 17 22 12c0-5.5-4.5-10-10-10z"></path></svg>
                            facebook.com/PetsSocietybyZoetis</a>
                    </ul>
                </div>
            </section>
        </div>
        <div class="bg-secondary-red w-full p-2">
            <section class="container grid md:grid-cols-2 m-auto text-center">
                <div class="md:text-left">
                    <a href="#" class="hover:text-primary-blue">Privacy Policy</a> |  <a href="#" class="hover:text-primary-blue">Cookie Settings</a>
                </div>
                <div class="md:text-right">
                    COPYRIGHT © 
                    <a href="#" class="hover:text-primary-blue">Super TRIO</a>
                    2022  – ALL RIGHTS RESERVED.
                </div>
            </section>
        </div>
    </footer>
</x-base-layout>
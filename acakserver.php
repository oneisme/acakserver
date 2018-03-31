<? php
/ **
 * Perenderaan Render Cepat dan kotor
 * /
require ( ' lib / config.php ' );
require ( ' lib / markdown.php ' );
// Konversi? Q ke dalam path file
$ q  =  $ _GET [ ' q ' ]? $ _GET [ ' q ' ]: ' index.md ' ;
$ q  =  str_replace ( $ base_path , ' ' , $ q );
$ file  =  $ base_path  .  ' / '  .  $ q ;
$ mtime  =  filemtime ( $ file );
// Cobalah untuk mencegah jalur file nakal
if ( FALSE  &&  realpath ( $ file ) ! ==  $ file ) {
    tajuk ( ' HTTP / 1.1 403 Forbidden ' );
    echo  " Forbidden " ; keluar ;
}
if ( ! is_file ( $ file )) {
    
    // Tidak ada file yang ditemukan, jadi panik.
    $ title  =  " Tidak ditemukan " ;
    $ text  =  ' file tidak ditemukan ' ;
} else {
    // Ambil konten file dan render dengan Markdown
    $ data  =  file_get_contents ( $ file );
    $ text  = Markdown ( $ data );
    // Cobalah untuk mengangkat baris pertama sebagai judul halaman, jika itu adalah H1
    $ lines  =  meledak ( " \ n " , $ data );
    if ( count ( $ lines ) >  0  &&  0  ==  strpos ( $ lines [ 0 ], ' # ' )) {
        $ parts  =  meledak ( "  " , $ lines [ 0 ]);
        array_shift ( $ bagian );
        $ title  =  join ( '  ' , $ parts );
    }
}
? >
< html >
    < meta  http-equiv = " content-type "  content = " text / html; charset = UTF-8 " />
    < head >
        < title > <? = htmlspecialchars ( $ title ) ? > </ title >
        < style >
            artikel , footer , header , hgroup , nav , section { display : block ; }
        < / style >
        < jenis tautan  = " teks / css " rel = " stylesheet " href = " <? = $ base_url ? > /css/render.css " />  
        < jenis skrip  = " teks / javascript " >
            var disqus_shortname =  ' <? = htmlspecialchars ( $ disqus_shortname ) ? > '  ;
            <? php jika ( $ disqus_developer ): ? > 
                var disqus_developer =  1 ;
            <? php endif ? >  
        < / script >
        <! - [jika IE]>
            <script src = " <? = $ base_url ? > /js/html5.js" type = "text / javascript" /> </ script>
        <! [endif] ->
        < script  src = " <? = $ base_url ? > /js/jquery-1.3.2.min.js "  type = " text / javascript " /> </ script >
        < script  src = " <? = $ base_url ? > /js/md5-min.js "  type = " text / javascript " /> </ script >
        < script  src = " <? = $ base_url ? > /js/outliner.js "  type = " text / javascript " /> </ script >
        < script  src = " <? = $ base_url ? > /js/render.js "  type = " text / javascript " /> </ script >
    </ kepala >
    < body >
        < header >
            < H1 > < a  rel = " rumah "  title = " 0xDECAFBAD "  href = " http://decafbad.com/ " > 0xDECAFBAD </ a > </ h1 >
            < span > Ini semua roda berputar dan keraguan diri sampai teko kopi pertama. </ span >
        </ header >

        < article >
            < time  datetime = " <? = tanggal ( " c " , $ mtime ) ? > "  pubdate > < span > <? = tanggal ( " D, YM d @ H: i O " , $ mtime ) ? > </ span > </ time >

            < section > <? = $ text ? > </ section >

            < section  class = " comments " >

                < div  id = " disqus_thread " > </ div >
                < jenis skrip  = " teks / javascript " >
                    ( function () {
                        var dsq =  dokumen . createElement ( ' script ' ); dsq . ketik  =  ' text / javascript ' ; dsq . async  =  true ;
                        dsq . src  =  ' http: // '  + disqus_shortname +  ' .disqus.com / embed.js ' ;
                        ( dokumen . getElementsByTagName ( ' kepala ' ) [ 0 ] ||  dokumen . getElementsByTagName ( ' body ' ) [ 0 ]). appendChild (dsq);
                    }) ();
                < / script >
                < Noscript > Silahkan aktifkan JavaScript untuk melihat < a  href = " http://disqus.com/?ref_noscript " > komentar powered by Disqus. </ A > </ noscript >
                < A  href = " http://disqus.com "  class = " DSQ-brlink " > komentar powered by < rentang  class = " logo-Disqus " > Disqus </ rentang > </ a >

            </ section >
        </ article >
    </ body >
</ html >

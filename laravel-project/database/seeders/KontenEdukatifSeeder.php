<?php

namespace Database\Seeders;

use App\Models\KataKunciKonten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KontenEdukatif;

class KontenEdukatifSeeder extends Seeder
{
    public function run()
    {
        KontenEdukatif::create([
            'id' => 1,
            'id_user' => 2,
            'judul' => 'Mengenal Pentingnya Kesehatan Mental pada Remaja',
            'tipe' => 'artikel',
            'thumbnail' => 'seeder/konten-edukatif/3.png',
            'sumber' => 'Kemenkes',
            'isi_artikel' => 'Kena mental lu…
            Kata-kata itu sering terdengar pada anak-anak remaja zaman sekarang, untuk membully maupun melamahkan lawan bicara. Namun hal ini sepertinya sudah menjadi trend di kalangan remaja sekarang.
            Kesehatan mental dipengaruhi oleh peristiwa dalam kehidupan yang meninggalkan dampak yang besar pada kepribadian dan perilaku seseorang. Peristiwa-peristiwa tersebut dapat berupa kekerasan dalam rumah tangga, pelecehan anak, atau stres berat jangka panjang.
            Jika kesehatan mental terganggu, maka timbul gangguan mental atau penyakit mental. Gangguan mental dapat mengubah cara seseorang dalam menangani stres, berhubungan dengan orang lain, membuat pilihan, dan memicu hasrat untuk menyakiti diri sendiri.
            
            Pengertian Kesehatan Mental
            Kesehatan mental merupakan kondisi dimana individu memiliki kesejahteraan yang tampak dari dirinya yang mampu menyadari potensinya sendiri, memiliki kemampuan untuk mengatasi tekanan hidup normal pada berbagai situasi dalam kehidupan, mampu bekerja secara produktif dan menghasilkan, serta mampu memberikan kontribusi kepada komunitasnya.
            
            Gejala Gangguan Mental
            Berikut adalah beberapa gejala atau tanda penyakit mental yang mungkin terjadi pada anak :
            
            1. Perubahan perilaku
            Ini merupakan tanda munculnya penyakit mental pada anak yang tergolong mudah Anda sadari melalui aktivitas sehari-hari baik di rumah maupun di sekolah. Ketika anak menjadi lebih sering bertengkar, cenderung kasar, hingga berkata kasar yang menyakitkan orang lain padahal sebelumnya tidak, Anda perlu curiga. Tak hanya itu saja, Anda juga mungkin melihat perubahan perilaku anak seperti menjadi lebih mudah marah dan merasa frustasi.
            
            2. Perubahan mood
            Tanda penyakit mental lainnya adalah mood atau suasana hati anak yang berubah secara tiba-tiba. Kondisi ini bisa berlangsung sebentar hingga dalam jangka waktu yang tidak menentu.
            Tentunya, hal ini bisa mengakibatkan masalah pada hubungan dengan keluarga serta teman sebaya. Ini merupakan gejala umum dari depresi, ADHD, hingga kelainan bipolar.
            
            3. Kesulitan berkonsentrasi
            Anak-anak yang menderita gangguan mental cenderung sulit fokus atau memperhatikan dalam waktu yang lama. Selain itu, mereka juga memiliki kesulitan untuk duduk diam dan membaca. Tanda penyakit mental yang satu ini dapat menyebabkan menurunnya performa di sekolah juga perkembangan otaknya.
            
            4. Penurunan berat badan
            Tahukah Anda bahwa gangguan mental juga dapat memengaruhi kondisi fisik anak? Tak hanya karena penyakit fisik, berat badan yang menurun drastis juga bisa menjadi tanda penyakit mental anak. Gangguan makan, stres, hingga depresi dapat menjadi penyebab anak kehilangan nafsu makan, mual, dan muntah yang berkelanjutan.
            
            5. Menyakiti diri sendiri
            Perhatikan saat anak sering mengalami kekhawatiran serta rasa takut berlebih. Perasaan ini dapat berujung pada keinginannya untuk menyakiti diri sendiri.
            Biasanya, ini menjadi akumulasi dari perasaan stres serta menyalahkan diri sendiri karena gangguan mental juga mengakibatkan anak sulit mengelola emosi. Ini juga menjadi tanda gangguan mental pada anak yang perlu Anda cermati karena tidak menutup kemungkinan berujung pada percobaan bunuh diri.
            
            6. Muncul berbagai masalah kesehatan
            Penyakit atau gangguan mental juga dapat ditandai dengan masalah pada kesehatannya, misal anak mengalami sakit kepala dan sakit perut yang berkelanjutan.
            
            7. Perasaan yang intens
            Anak-anak kadang menghadapi perasaan takut yang berlebihan tanpa alasan. Tanda gangguan mental pada anak ini seperti menangis, berteriak atau mual disertai dengan perasaan sangat intens. Perasaan ini pun dapat menyebabkan efek seperti kesulitan bernapas, jantung berdebar atau bernapas dengan cepat, yang dapat mengganggu aktivitas sehari-hari.
            
            Ciri-ciri Kesehatan Mental Yang Baik
            Anak remaja dengan kesehatan mental yang baik seringkali memiliki ciri-ciri sebagai berikut :
            1.      merasa lebih bahagia dan lebih positif tentang diri mereka sendiri dan menikmati hidup
            2.      bangkit kembali dari kekesalan dan kekecewaan
            3.      memiliki hubungan yang lebih sehat dengan keluarga dan teman
            4.      melakukan aktivitas fisik dan makan makanan yang sehat
            5.      terlibat dalam kegiatan
            6.      memiliki rasa pencapaian
            7.      bisa bersantai dan tidur nyenyak
            8.      merasa nyaman di komunitas mereka.',
            'link_youtube' => null,
        ]);
        KataKunciKonten::insert([
            ['id_konten' => 1, 'nama' => 'kesehatan mental'],
            ['id_konten' => 1, 'nama' => 'remaja'],
            ['id_konten' => 1, 'nama' => 'gangguan mental'],
        ]);

        KontenEdukatif::create([
            'id' => 2,
            'id_user' => 3,
            'judul' => 'On Marissas Mind: Kuat Mental',
            'tipe' => 'video',
            'thumbnail' => 'seeder/konten-edukatif/4.png',
            'sumber' => 'Greatmind',
            'isi_artikel' => null,
            'link_youtube' => 'https://www.youtube.com/embed/9kdHXQ7BPc8',
        ]);
        KataKunciKonten::insert([
            ['id_konten' => 2, 'nama' => 'mental'],
            ['id_konten' => 2, 'nama' => 'psikologi'],
            ['id_konten' => 2, 'nama' => 'kesehatan mental'],
        ]);

        KontenEdukatif::create([
            'id' => 3,
            'id_user' => 4,
            'judul' => 'Menjaga Kesehatan Mental: Tips dan Trik Harian',
            'tipe' => 'artikel',
            'thumbnail' => 'seeder/konten-edukatif/1.png',
            'sumber' => 'Rumah Sakit Pertamina Pusat',
            'isi_artikel' => '
            Kesehatan mental yang baik merupakan pondasi utama bagi kehidupan yang seimbang dan bahagia. Dalam kesibukan sehari-hari, seringkali kita lupa untuk memberikan perhatian yang cukup pada kesehatan mental kita. Berikut adalah beberapa tips dan trik harian yang dapat membantu Anda menjaga kesehatan mental:
            
            1. Berolahraga Secara Teratur
            Olahraga tidak hanya bermanfaat bagi kesehatan fisik, tetapi juga memiliki dampak positif pada kesehatan mental. Aktivitas fisik dapat meningkatkan produksi endorfin, hormon yang dapat meningkatkan suasana hati dan mengurangi stres. Sediakan waktu setiap hari untuk bergerak, entah itu dengan berjalan-jalan, berlari, atau melakukan olahraga favorit Anda.
            
            2. Tidur Cukup
            Kurang tidur dapat berdampak negatif pada kesehatan mental dan kesejahteraan secara keseluruhan. Pastikan untuk mendapatkan 7-9 jam tidur setiap malam. Rutinitas tidur yang baik dapat membantu menjaga keseimbangan emosional dan meningkatkan ketahanan terhadap stres.
            
            3. Menerapkan Teknik Relaksasi
            Teknik-teknik relaksasi seperti meditasi, yoga, dan pernapasan dalam dapat membantu mengurangi tingkat stres dan meningkatkan fokus. Sisihkan waktu setiap hari untuk melibatkan diri dalam praktik relaksasi ini, baik pagi atau malam.
            
            4. Mengatur Waktu untuk Kesenangan
            Tentukan waktu untuk melakukan aktivitas yang Anda nikmati. Itu bisa berupa membaca buku, menonton film, mendengarkan musik, atau melakukan hobi kreatif. Kegiatan-kegiatan ini dapat menjadi pelarian yang menyenangkan dan membantu mengurangi tekanan.
            
            5. Menjaga Koneksi Sosial
            Hubungan sosial yang baik dapat memiliki dampak positif pada kesehatan mental. Ajak teman-teman atau keluarga untuk berkumpul, atau jika tidak memungkinkan secara fisik, pertahankan komunikasi melalui panggilan telepon atau video call. Rasa dukungan sosial dapat memberikan ketenangan pikiran.
            
            6. Mengelola Tugas Secara Bertahap
            Jangan terlalu keras pada diri sendiri. Bagi tugas besar menjadi tugas yang lebih kecil dan kelola satu langkah pada satu waktu. Ini dapat membantu mengurangi rasa kewalahan dan meningkatkan rasa pencapaian.
            
            7. Bersikap Positif dan Berterima Kasih
            Fokus pada hal-hal positif dalam hidup dan praktikkan rasa syukur. Menuliskan hal-hal yang membuat Anda bersyukur setiap hari dapat meningkatkan suasana hati dan membantu menjaga perspektif positif.
            
            8. Mencari Bantuan Profesional Jika Diperlukan
            Jika Anda merasa kesulitan mengatasi masalah kesehatan mental, jangan ragu untuk mencari bantuan dari profesional. Psikolog, psikiater, atau konselor dapat memberikan dukungan dan alat yang Anda butuhkan.
            
            Dengan mengintegrasikan tips dan trik ini ke dalam rutinitas harian, Anda dapat membangun dasar yang kokoh untuk menjaga kesehatan mental Anda. Ingatlah bahwa kesehatan mental adalah perjalanan yang berkelanjutan, dan memberikan perhatian terus-menerus adalah kunci untuk mencapai keseimbangan dan kebahagiaan.
            ',
            'link_youtube' => null,
        ]);
        KataKunciKonten::insert([
            ['id_konten' => 3, 'nama' => 'tips mental'],
            ['id_konten' => 3, 'nama' => 'kesehatan mental'],
            ['id_konten' => 3, 'nama' => 'olahraga dan kesehatan mental'],
        ]);

        KontenEdukatif::create([
            'id' => 4,
            'id_user' => 3,
            'judul' => '5 Tips Menjaga Kesehatan Mental Menurut Psikolog',
            'tipe' => 'video',
            'thumbnail' => 'seeder/konten-edukatif/5.png',
            'sumber' => 'Kompas.com',
            'isi_artikel' => null,
            'link_youtube' => 'https://www.youtube.com/embed/DqQHIZSoJRI',
        ]);
        KataKunciKonten::insert([
            ['id_konten' => 4, 'nama' => 'tips psikolog'],
            ['id_konten' => 4, 'nama' => 'kesehatan mental'],
            ['id_konten' => 4, 'nama' => 'psikologi'],
        ]);

        KontenEdukatif::create([
            'id' => 5,
            'id_user' => 4,
            'judul' => 'Bagaimana Menjaga Kesehatan Mental',
            'tipe' => 'artikel',
            'thumbnail' => 'seeder/konten-edukatif/2.png',
            'sumber' => 'IHC Telemed',
            'isi_artikel' => '
            Peribahasa “di dalam tubuh yang sehat, terdapa jiwa yang kuat” sudah tidak asing lagi di telinga masyarakat Indonesia. Namun, kebanyakan orang mengartikan sehat hanya pada faktor fisik yang terbebas dari penyakit. Sejatinya, predikat sehat juga meliputi kesehatan mental.
            Bila mengacu pada organisasi kesehatan dunia (WHO) yang menegaskan, bahwa kesehatan merupakan kondisi fisik, mental dan sosial yang lengkap, tidak hanya sekadar tubuh yang bebas dari penyakit atau seuatu kelemahan. Oleh karena itu, kesehatan mental pun juga perlu diperhatikan.
            Mengapa kesehatan mental perlu dijaga? Karena dasar bagi kemampuan manusia untuk berpikir, berekspresi, berinteraksi, berkembang, bekerja hingga mencari hiburan adalah kesehatan mental.
            
            Di sisi lain, organisasi kesehatan dunia (WHO) juga menjelaskan bila seseorang memiliki kondisi mental yang sehat, akan membantu dalam menunjang beberapa hal, seperti:
            · Menyadari batas kesanggupannya
            · Produktivitas kerja
            · Mengelola stres dari masalah yang datang setiap hari
            · Mengetahui peran yang sanggup diemban untuk sekitarnya
            
            Bila seseorang tidak dapat melakukan hal-hal diatas dengan baik, bisa saja orang tersebut mengalami gangguan kesehatan mental. Kesehatan mental seseorang dapat dipengaruhi oleh beberapa faktor, antara lain:
            · Memiliki keluarga dengan riwayat gangguan mental
            · Riwayat penyakit yang diderita
            · Beban pikiran
            · Pengalaman hidup yang buruk, seperti pernah mengalami tindak kekerasan atau pelecehan seksual
            · Gaya hidup
            · Tuntutan sosial dan ekonomi
            
            Beberapa faktor ini menjelaskan bahwa kesehatan mental dapat dipengaruhi oleh faktor psikologis, biologis dan sosial.
            Terdapat beberapa cara yang dapat dilakukan untuk menjaga serta memperbaiki kesehatan mental, diantaranya:
            
            1. Melakukan manajemen stres dengan baik
            Meskipun stres merupakan hal yang sulit dihindari, namun stres dapat diatasi. Lakukan aktivitas-aktivitas yang dapat membantu dalam mengelola stres, seperti bertukar pikiran dengan sahabat, olahraga, meditasi, menulis buku harian, melakukan sesuatu yang digemari hingga mengucapkan kalimat positif untuk diri sendiri. walaupun terkesan sepele, hal tersebut dapat membantu pikiran untuk lebih tenang dan melihat hidup menjadi lebih jernih.
            
            2. Berkumpul bersama orang terkasih
            Menghabiskan waktu bersama orang-orang tersayang yang selalu mendukung dan memberi semangat atas apa yang dilakukan dapat membantu diri dalam melepaskan rasa penat. Habiskan waktu ketika berkumpul dengan bercerita, bersenda gurau, meluapkan emosi dan berbagi pengalaman agar dapat memperoleh saran serta dukungan dari mereka atas apa yang dilakukan. Hal ini dinilai ampuh, karena seseorang yang punya hubungan sosial yang baik, terbukti lebih sehat, lebih sedikit mengalami gangguan kesehatan dan dapat hidup lebih lama.
            
            3. Lakukan hal baru
            Cobalah untuk melakukan hal baru atau ciptakan suasana baru agar rutinitas sehari-hari menjadi sedikit berbeda. Karena aktivitas yang monoton dapat memicu seseorang menjadi mudah stres. Oleh karena itu, lakukan hal atau sesuatu yang baru agar pikiran menjadi lebih segar dan bisa membuat lebih semangat menjalani aktivitas.
            
            4. Buat tujuan yang realistis
            Dengan memahami apa yang menjadi tujuan hidup akan membuat hidup menjadi lebih terarah dalam mencapai tujuan tersebut. Tetapkan tujuan yang realistis. Bahkan bila perlu, tulis tujuan tersebut dan dipajang di dinding kamar atau meja kerja. Agar lebih semangat, lengkapi dengan target waktu atau hal yang lebih spesifik serta tuangkan juga tujuan-tujuan yang telah tercapai.
            
            5. Membantu orang lain
            Melakukan kegiatan yang bermanfaat seperti menolong hingga melakukan kegiatan kerelawanan dapat membuat diri merasa lebih baik dan lebih bermanfaat dalam hidup. Di sisi lain, melakukan aktivitas tersebut juga dapat membantu menghilangkan rasa kesepian dan rasa tidak berguna, serta membuat diri menjadi lebih bersyukur, tidak mudah mengeluh atau putus asa.
            
            6. Menjaga kesehatan tubuh
            Kesehatan mental juga tergantung pada cara seseorang dalam merawat dirinya. Baik merawat kesehatan tubuh, hingga merawat atau menjaga penampilan. Hal ini sangat bermanfaat, karena selain mendapatkan mental yang sehat, fisik yang prima juga akan didapatkan.
            ',
            'link_youtube' => null,
        ]);
        KataKunciKonten::insert([
            ['id_konten' => 5, 'nama' => 'kesehatan mental'],
            ['id_konten' => 5, 'nama' => 'perawatan diri'],
            ['id_konten' => 5, 'nama' => 'stress management'],
        ]);
    }
}

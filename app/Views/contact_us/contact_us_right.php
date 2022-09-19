<div class="col-6 col-md-4" style="font-family: 'Poppins';">
    <h5 class="cilor wow fadeInRight" style="font-family: 'Poppins'; text-align:left;">Kontak Kami</h5>
    <p class="pb-2 wow fadeInRight" style="text-align:left;"><span style="color: #55341D; font-family: 'Poppins';">Kantor</span></p>
    <p class="custem-p-ah wow fadeInRight" style="font-family: 'Poppins'; text-align:left;">Gading Bukit Indah Blok A No 27 <br> Kelapa Gading Barat, Kelapa Gading
        <br> Jakarta Utara 14240
    </p>
    <!-- <p class="custem-p-customer-ah">Customer Service</p>
    <p class="custem-p-ah"><i class="far fa-envelope"></i>cs.apps@panensaham.com</p>
    <p class="custem-p-ah"><i class="fas fa-phone-square"></i>021-45852710</p> -->
    <p class="pb-2 wow fadeInRight" style="text-align:left;"><span style="color: #55341D; font-family: 'Poppins'; text-align:left;">Customer Support</span></p>
    <p class="custem-p-ah wow fadeInRight" style="font-family: 'Poppins'; text-align:left;"><i class="fa-solid fa-envelope fa-flip" style="--fa-animation-duration: 3s";></i>support.monika@panensaham.com</p>
    <!-- <p class="custem-p-ah"><i class="fas fa-phone-square"></i>021-45852711</p> -->
    <p class="custem-p-ah wow fadeInRight" style="font-family: 'Poppins'; text-align:left;"><i class="fa-brands fa-whatsapp fa-flip" style="--fa-animation-duration: 3s";></i>WA CS : <a href="https://api.whatsapp.com/send?phone=6282148004900">082148004900</a></p>
    <!-- <p class="custem-p-ah" style="font-family: 'Poppins';">WA CS 2 : <a href="https://api.whatsapp.com/send?phone=6282148005800">082148005800</a></p> -->
    <p class="pb-2 wow fadeInRight" style="text-align:left;"><span style="color: #55341D; font-family: 'Poppins'; text-align:left;">Formulir Kontak</span></p>
    <!-- <form action=""> -->
    <?= form_open('contactusprocess', ['class' => 'Formcontact']); ?>
    <?= csrf_field(); ?>

    <div class="form-group wow fadeInRight">
        <input type="text" id="nama" name="nama" class="form-conti" placeholder="Nama Lengkap" required>
        <div class="invalid-feedback bg-secondary errorNama">testte</div>
    </div>
    <div class="form-group wow fadeInRight">
        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" style="text-transform: lowercase" id="email" name="email" class="form-conti" placeholder="Email" required>
        <div class="invalid-feedback bg-secondary errorEmail">testte</div>
    </div>
    <div class="form-group wow fadeInRight">
        <input type="tel" pattern="^\d{12}$" id="phone" name="phone" class="form-conti" placeholder="No. HP" required>
        <div class="invalid-feedback bg-secondary errorPhone">testte</div>
    </div>
    <div class="form-group wow fadeInRight">
        <textarea class="form-conti" id="isi_pesan" name="isi_pesan" rows="50" placeholder="Pesan Anda" required></textarea>
        <div class="invalid-feedback bg-secondary errorNama">testte</div>
    </div>
    <button type="submit" style="width:auto; font-family: 'Poppins'; font-weight:bold;" class="boxed-save wow fadeInRight" tabindex="4" id="btnsend">
        Kirim Pesan
    </button>

    <?= form_close(); ?>
    <!-- </form> -->
</div>
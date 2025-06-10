<div class="footer mt-5" style="background-color: #343a40;">     
  <div class="container py-5">
    <div class="row g-0 align-items-start justify-content-between">

      <!-- Contact Info -->
<div class="col-md-5 d-flex align-items-center no-padding">
  <div style="display: flex; flex-direction: column; align-items: flex-start;">
    <h4 class="text-white" style="margin-bottom: 20px;">Contact Us</h4>
    <div class="footerContactUs">
      <div class="d-flex mb-4" style="align-items: flex-start;">
        <div style="width: 24px; margin-right: 15px; display: flex; justify-content: left;">
          <i class="fas fa-envelope text-white fs-5"></i>
        </div>
        <div class="text-white mb-0" style="flex: 1; text-align: left;">
          smpn1siantarnarumonda@gmail.com
        </div>
      </div>
      <div class="d-flex mb-4" style="align-items: flex-start;">
        <div style="width: 24px; margin-right: 15px; display: flex; justify-content: left;">
          <i class="fas fa-phone-alt text-white fs-5"></i>
        </div>
        <div class="text-white mb-0" style="flex: 1; text-align: left;">
          +6285370204640
        </div>
      </div>
      <div class="d-flex" style="align-items: flex-start;">
        <div style="width: 24px; margin-right: 15px; padding-top: 2px; display: flex; justify-content: left;">
          <i class="fas fa-map-marker-alt text-white fs-5"></i>
        </div>
        <div class="text-white mb-0" style="flex: 1; text-align: left;">
          Jl. Narumonda 1, Kec. Siantar Narumonda,<br>
          Kab. Toba Samosir, Sumatera Utara
        </div>
      </div>
    </div>
  </div>
</div>



      <!-- Right side: peta + login di kiri, social media di kanan -->
      <div class="col-md-7 no-padding d-flex" style="gap: 50px; align-items: flex-start;">

        <!-- Kiri: peta + login (vertical stack) -->
        <div style="width: 70%; display: flex; flex-direction: column;">

          <!-- Map -->
          <div class="map-responsive rounded shadow-lg mb-3" style="overflow:hidden; padding-bottom: 50%; position:relative; height:0;">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.2307316401584!2d99.17727927472748!3d2.4299365975490925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031fffd46ea54db%3A0xb02f329d28038c86!2sSMP.N%201%20Siantar%20Narumonda!5e0!3m2!1sid!2sid!4v1743496914989!5m2!1sid!2sid" 
              width="100%" 
              height="150" 
              style="border:0; position:absolute; top:0; left:0;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>

          <!-- Login, tepat di bawah peta, ujung kanan -->
          <div style="margin-left: auto;">
            <div class="d-flex justify-content-end">
              <div class="text-end">
                <a href="{{ route('admin.login') }}" class="btn btn-outline-light btn-sm">
                  Login
                </a>
                <div class="text-white mt-1" style="font-size: 13px;">
                  Admin Area
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Kanan: Social Media Links -->
        <div style="width: 30%; display: flex; flex-direction: column; gap: 10px; padding-left: 15px;">
          <h5 class="text-white" style="margin-bottom: 10px; line-height: 1; white-space: nowrap;">Media Sosial Kami</h5>
          <div style="display: flex; gap: 15px;">
            <a href="https://www.facebook.com/share/19F1vJ7Bav/" target="_blank" class="text-white d-flex align-items-center" style="text-decoration: none; font-size: 2.5rem;">
              <i class="fab fa-facebook-square"></i>
            </a>
            <a href="https://www.instagram.com/smpn1.siantarnarumonda?igsh=d2JnMXpveTZ6Z3Y5" target="_blank" class="text-white d-flex align-items-center" style="text-decoration: none; font-size: 2.5rem;">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://youtube.com/@smpnegeri1siantarnarumonda873?si=Cq53n_r7c0LzAbnG" target="_blank" class="text-white d-flex align-items-center" style="text-decoration: none; font-size: 2.5rem;">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>

      </div>

    </div>
  </div>

  <!-- Copyright -->
  <div style="background-color: #111111; height: 45px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 13px;">
    &copy; 2025 SMPN 1 Siantar Narumonda. All rights reserved.
  </div>
</div>

<style>
  .footer a.text-white i {
    transition: color 0.3s ease;
  }
  .footer a.text-white .fa-facebook-square:hover {
    color: #3b5998; 
  }
  .footer a.text-white .fa-instagram:hover {
    color: #e1306c;
  }
  .footer a.text-white .fa-youtube:hover {
    color: #ff0000;
  }
</style>
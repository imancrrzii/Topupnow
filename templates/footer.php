<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up">
          <h4>Group 5 </h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021282126034-9-10001&akt=2021">Anharul
                Zikri</a></li>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021282126004-9-10001&akt=2021">Aisyah Nur
                Khoirofiq</a></li>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021282126009-9-10001&akt=2021">Iman Carrazi
                Syamsidi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021282126033-9-10001&akt=2021">Muhammad
                Nurhadi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021282126036-9-10001&akt=2021">Tasya
                Khadijah</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up">
          <h4>ID Student</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021282126034-9-10001&akt=2021">09021182126034</a>
            </li>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021182126004-9-10001&akt=2021">09021182126004</a>
            </li>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021182126009-9-10001&akt=2021">09021182126009</a>
            </li>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021182126033-9-10001&akt=2021">09021182126033</a>
            </li>
            <li><i class="bx bx-chevron-right"></i> <a
                href="https://old.unsri.ac.id/?act=detil_mahasiswa&mhs=09021282126036-9-10001&akt=2021">09021182126036</a>
            </li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url; ?>">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url; ?>about_us.php">About us</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url; ?>kategori_index.php">Categories</a>
            </li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url; ?>contact_us.php">Contact Us</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up">
          <h4>Our Social Networks</h4>
          <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
          <div class="social-links mt-3">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container footer-bottom clearfix">
    <div class="copyright">
      &copy; Copyright <strong><span>Group 5</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by Group 5</a>
    </div>
  </div>
</footer>

<script src="assets/js/script.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
  AOS.init();
</script>
<script src="https://kit.fontawesome.com/812cea5233.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  let fadeTarget = document.querySelector('.loading');

  document.addEventListener('DOMContentLoaded', function () {
    hide_loading();
  });

  function hide_loading() {
    let fadeEffect = setInterval(() => {
      if (!fadeTarget.style.opacity) {
        fadeTarget.style.opacity = 1;
      }
      if (fadeTarget.style.opacity > 0) {
        fadeTarget.style.opacity -= 0.1;
      } else {
        clearInterval(fadeEffect);
        fadeTarget.style.display = 'none';
      }
    }, 50)
  }
</script>
</body>

</html>
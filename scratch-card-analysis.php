<?php require "admin-header.php"; ?>



<main id="main" class="main">

<div class="pagetitle">
  <h1>ApexCharts</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Charts</li>
      <li class="breadcrumb-item active">ApexCharts</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<?php
                $sql = "SELECT * FROM scratch_card WHERE verified='1'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $count = $result->num_rows;
                $total = $count * 700;
                echo "The number of students that have paid is " . $count;
                echo "Total amount of amount is " . $total;
                  
                      ?>

<p>ApexCharts Examples. You can check the <a href="https://apexcharts.com/javascript-chart-demos/" target="_blank">official website</a> for more examples.</p>

<section class="section">
  <div class="row">

    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Line Chart</h5>  

              <!-- Slides with captions -->
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="./assets/img/greatkings/158.jpg" style="background: linear-gradient(green, red);" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-md-block">
                      <h5 class="fw-bold">First slide label</h5>
                      <p>Some representative placeholder content for the first slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets/img/slides-2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Second slide label</h5>
                      <p>Some representative placeholder content for the second slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets/img/slides-3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Third slide label</h5>
                      <p>Some representative placeholder content for the third slide.</p>
                    </div>
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with captions -->

        </div>
      </div>
    </div>
   

  </div>
</section>

</main><!-- End #main -->



<?php require "main-footer.php"; ?>
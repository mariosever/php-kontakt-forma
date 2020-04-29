<?php

  // Alert poruke

  $alertPoruka = '';
  $alertKlasa = '';


  if(filter_has_var(INPUT_POST, 'submit')) {

    // uzmi podatke iz forme

    $imePrezime = htmlspecialchars($_POST['imePrezime']);
    $email = htmlspecialchars($_POST['email']);
    $poruka = htmlspecialchars($_POST['poruka']);

    // Provjeri polja

    if(!empty($imePrezime) && !empty($email) && !empty($poruka)) {

      // Polja su ispunjena
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

        // email nije ok
        $alertPoruka = 'Email adresa nije ispravna!';
        $alertKlasa = 'alert-danger';

      } else {

        // email je ok, šalji podatke na mail

        // email na koji šaljemo 
        $toEmail = 'info@programiranjezaweb.com';

        // subject
        $subject = 'Upit od '. $imePrezime;

        // body
        $body = '<h2>Upit</h2>
                 <h4>Ime i prezime</h4><p>' . $imePrezime . '</p>
                 <h4>Email</h4><p>' . $email . '</p>
                 <h4>Poruka</h4><p>' . $poruka . '</p>'; 

        // email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "From: " . $imePrezime . "<" . $email . ">" . "\r\n";

        // slanje podataka na mail
        if(mail($toEmail, $subject, $body, $headers)) {

          // uspjeh
          $alertPoruka = 'Poruka je uspješno poslana!';
          $alertKlasa = 'alert-success';

        }  else {

          // neuspjeh
          $alertPoruka = 'Došlo je do greške!';
          $alertKlasa = 'alert-danger';

        }   


      }

  } else {

    // Greška
    $alertPoruka = 'Molimo ispunite sva polja!';
    $alertKlasa = 'alert-danger';

  }


}


?>



<!DOCTYPE html>
<html lang="hr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Kontakt forma</title>
  </head>
  <body>
    
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">PHP kontakt forma</a>
    </div>
  </nav>

  <div class="container mt-5">

    <?php if($alertPoruka != ''):  ?>

      <div class="alert <?php echo $alertKlasa?>"><?php echo $alertPoruka; ?></div>

    <?php endif; ?>
    

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

      <div class="form-group">
        <label>Ime i prezime</label>
        <input type="text" class="form-control" name="imePrezime" id="imePrezime" value="<?php echo isset($_POST['imePrezime']) ? $imePrezime : ''; ?>">
      </div>

      <div class="form-group">
        <label>Email adresa</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
      </div>

      <div class="form-group">
        <label>Vaša poruka:</label>
        <textarea class="form-control" name="poruka" id="poruka" rows="3"><?php echo isset($_POST['poruka']) ? $poruka : ''; ?></textarea>
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary btn-lg">Pošalji</button>

    </form>


  </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
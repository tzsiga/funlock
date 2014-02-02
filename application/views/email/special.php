<?php $this->load->view('header'); ?>
  <body id="confirm-email">
    <h2>Kedves Csapat!</h2>
    <p>Örülünk, hogy elvállaltátok a küldetést! Mielőtt a helyszínre érkeznétek (időpontotok:  <?= date("Y-m-d H:i", $posted['appointment']) ?>), egy kisebb feladatot kell elvégeznetek:</p>
    <ol>
      <li>Itt <a href="<?= base_url().'assets/email/funlock_prof_ossz.pdf' ?>" target="_blank">megtaláljátok</a> a professzorról tudomásunkra jutott információkat. Tanulmányozzátok át, hogy rájöjjetek a bejutáshoz szükséges kombinációra!</li>
      <li>A "Hovamenjek" akció keretében az idővel fogtok versenyre kelni.<br/>Ha 30 percnél gyorsabban ki tudok szabadulni, akkor vendégeink voltatok a játékra!</li>
      <li>30 és 40 perc között a játék 6000 Ft.</li>
      <li>40 és 50 perc között 7000 Ft.</li>
      <li>50 és 60 perc között, vagy ha (véletlenül) nem juttok ki, akkor 7900 Ft.</li>
      <li>Fizetni a játék után, készpénzben tudtok majd.</li>
      <li>Érkezzetek időben és érezzétek jól magatokat!</li>
    </ol>
    <p>Várunk Titeket szeretettel:<br/><em>A Funlock csapata</em></p>
    <br/>
  </body>
</html>
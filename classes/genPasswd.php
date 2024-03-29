<?
function generatePassword($length=8, $strength=2) {
  $vowels = 'aeiou';
  $consonants = 'bdghjmnpqrstvyz';
  if ($strength & 1) $consonants .= 'BDGHJLMNPQRSTVWXYZ';
  if ($strength & 2) $vowels .= "AEIOU";
  if ($strength & 4) $consonants .= '23456789';
  if ($strength & 8) $consonants .= '@#$%';
  $password = '';
  $alt = time() % 2;
  for ($i = 0; $i < $length; $i++) {
    if ($alt == 1) {
	  $password .= $consonants[(rand() % strlen($consonants))];
	  $alt = 0;
	} else {
	  $password .= $vowels[(rand() % strlen($vowels))];
	  $alt = 1;
	}
  }
  return $password;
}
?>

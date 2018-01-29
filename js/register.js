
function validate(form) {
  fail = validateName(form.name.value)
  fail += validateUsername(form.username.value)
  fail += validatePassword(form.password.value)
  fail += confirm_password(form.password.value,form.confirm_password.value)

  if (fail == "") return true
  else {
    alert(fail); return false
     }
 };

 function validateUsername(field) {
 if (field == "") return "No Username was entered.\n"
 else if (field.length < 5) return "Usernames must be at least 5 characters.\n"
  else if (/[^a-zA-Z0-9_-]/.test(field))
    return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
    return ""
 };

 function validatePassword(field) {
if (field == "") return "No Password was entered.\n"
else if (field.length < 6)
  return "Passwords must be at least 6 characters.\n"
else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||!/[0-9]/.test(field))
  return "Passwords require one each of a-z, A-Z and 0-9.\n"
return ""
}

function validateName(field){
  return (field == "") ? "Enter a valid Name.\n"  : "";
}

function confirm_password(field1, field2){
  if(field1 != field2) return " Password doesnot match.\n";
  else return "";
}

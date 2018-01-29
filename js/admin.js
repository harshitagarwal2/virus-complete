function validate(form){
    malname_err = validate_Name(form.malname.value);

    if (malname_err == "") return true
    else {
      alert(malname_err); return false
       }
   };

function validate_Name(field){
  if(field == "") return "Malware Name is to be Entered";
  else return "";
}

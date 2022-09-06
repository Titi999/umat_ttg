function validate(){
    checkbox = document.getElementById("combined");
    if(checkbox.checked){
        document.getElementById("combined").value = "Yes"
        document.querySelector(".otherclass").style.display = "inline";
        document.querySelector(".combinedPeriods").style.display = "inline";
        document.querySelector(".LcombinedPeriods").style.display = "inline";
        document.querySelector(".combinedPeriods").setAttribute("required", "");
        document.querySelector(".otherclass").setAttribute("required", "");
    }
    else{
        document.getElementById("combined").value = "No"
        document.querySelector(".otherclass").style.display = "none";
        document.querySelector(".combinedPeriods").style.display = "none";
        document.querySelector(".LcombinedPeriods").style.display = "none";
        document.querySelector(".combinedPeriods").removeAttribute("required");
        document.querySelector(".otherclass").removeAttribute("required");
    }
}
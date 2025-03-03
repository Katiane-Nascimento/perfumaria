const divPerfume = document.getElementById("divPerfume");
const divSabonete = document.getElementById("divSabonete");
const sltProduto = document.getElementById("sltProduto");

sltProduto.addEventListener("change", function (){
    if (sltProduto.value == "perfume") {
        divPerfume.style.display = "block";
        divSabonete.style.display = "none"; 
    } else {
        divSabonete.style.display = "block"; 
        divPerfume.style.display = "none";
    }
});

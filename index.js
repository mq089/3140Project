function start()
{
   document.getElementById( "colorButton" ).addEventListener("click", changeColor, false );
} // end function start

function changeColor(){
   var color = document.getElementById("color").value;
   document.body.style.backgroundColor = color;
}

function checkInput() {

   var taskName = document.getElementById('taskName').value;
   var dataChosen = document.getElementById('dataChosen').value;
   var taskDesc = document.getElementById('taskDesc').value;

   if (taskName.trim() === '') {
      alert('Please enter something in task name before submitting.');
   }
   if (dataChosen.trim() === '') {
      alert('Please chose the date before submitting.');
   }
   if (taskDesc.trim() === '') {
      alert('Please enter something in Task Description before submitting.');
   }

   return;
}
    

window.addEventListener("load", start, false);
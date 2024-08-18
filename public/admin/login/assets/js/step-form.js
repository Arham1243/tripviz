

/*=======================================step form one start here=======================*/

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab, false); // Display the current tab

function showTab(n, shouldSubmit = false) {
    //    alert(shouldSubmit);
    //    if(shouldSubmit)
    //    {
    //        return;
    //    }
    console.log(n)
        // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.querySelectorAll(".prevBtn").forEach(btn => {
            btn.style.display = "inline";
            btn.style.visibility = "hidden";
        })
    } else {

        document.querySelectorAll(".prevBtn").forEach(btn => {
            btn.style.display = "inline";
            btn.style.visibility = "visible";
        })
    }
    if (n == (x.length - 1)) {

        document.getElementById("nextBtn").innerHTML = 'shake on it <i class="fa fa-arrow-right"></i> ';
        $("#nextBtn").addClass("sub");
		document.getElementById('nextBtn').onclick = function() {
				$('.request-participant-1').modal('hide');
				$('.thanks-modal').modal('show');					
		}
        $("#carousel, #slider").resize();
    } else {
        document.getElementById("nextBtn").innerHTML = 'next <i class="fa fa-arrow-right"></i>';
        $("#nextBtn").removeClass("sub");
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}


function nextPrev(n, event) {
    var timeOut = 0;
    
    if (window.activeSuggestionBoxButton && window.activeSuggestionBoxButton.length) {
        document.getElementById(window.activeSuggestionBoxButton).click();
        timeOut = 1000;
    }

    setTimeout(() => {

    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");

    console.log(event.target.innerHTML.toLowerCase());

    if (currentTab >= x.length - 1 && event && event.target.innerHTML.toLowerCase() === "complete") {
        $("#regForm").submit()


        return false;
    }

    // Exit the function if any field in the current tab is invalid:
    //  if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:

        // document.getElementById("regForm").submit();


        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab, currentTab >= x.length);
        
    }, timeOut)
}

function validateForm() {
    return true;
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}
/*============================================step form one start here ============================================*/


/*=======================================step form two start here=======================*/

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab, false); // Display the current tab

function showTab(n, shouldSubmit = false) {
    //    alert(shouldSubmit);
    //    if(shouldSubmit)
    //    {
    //        return;
    //    }
    console.log(n)
        // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.querySelectorAll(".prevBtn").forEach(btn => {
            btn.style.display = "inline";
            btn.style.visibility = "hidden";
        })
    } else {

        document.querySelectorAll(".prevBtn").forEach(btn => {
            btn.style.display = "inline";
            btn.style.visibility = "visible";
        })
    }
    if (n == (x.length - 1)) {

        document.getElementById("nextBtn").innerHTML = 'shake on it <i class="fa fa-arrow-right"></i> ';
        $("#nextBtn").addClass("sub");
		document.getElementById('nextBtn').onclick = function() {
				$('.request-participant-1').modal('hide');
				$('.thanks-modal').modal('show');					
		}
        $("#carousel, #slider").resize();
    } else {
        document.getElementById("nextBtn").innerHTML = 'next <i class="fa fa-arrow-right"></i>';
        $("#nextBtn").removeClass("sub");
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}


function nextPrev(n, event) {
    var timeOut = 0;
    
    if (window.activeSuggestionBoxButton && window.activeSuggestionBoxButton.length) {
        document.getElementById(window.activeSuggestionBoxButton).click();
        timeOut = 1000;
    }

    setTimeout(() => {

    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");

    console.log(event.target.innerHTML.toLowerCase());

    if (currentTab >= x.length - 1 && event && event.target.innerHTML.toLowerCase() === "complete") {
        $("#regForm-2").submit()


        return false;
    }

    // Exit the function if any field in the current tab is invalid:
    //  if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:

        // document.getElementById("regForm").submit();


        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab, currentTab >= x.length);
        
    }, timeOut)
}

function validateForm() {
    return true;
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}
/*============================================step form two end here ============================================*/


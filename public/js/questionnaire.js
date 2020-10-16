let items = [];
function addToArray(element) {
    if (!items.includes(element)) {
        items.push(element);
        console.log("Added " + element + " to array!");
    }
    else {
        console.log("Did not add " + element + " to the array, already in it!");
    }
    validateAndActiateButton(numberOfQuestions); //number of required items
}

function validateAndActiateButton(numberOfRequiredElements) {
    if (items.length === numberOfRequiredElements) {
        document.getElementById("submitButton").disabled = false;
        console.log("Disabled Continue Button")
    }
}
// Add an event listener to the Small image
document.getElementById("Small").addEventListener("click", function() {
    const bigImage = document.getElementById("Big");
    const smallImage = document.getElementById("Small");

    // Swap the `src` attributes of Big and Small images
    const tempSrc = bigImage.src;
    bigImage.src = smallImage.src;
    smallImage.src = tempSrc;
});

window.onload = function () {
    const lookupBtn = document.querySelector("#lookup");
    const resultDiv = document.querySelector("#result");

    lookupBtn.addEventListener("click", () => {
        const country = document.querySelector("#country").value.trim();

        fetch(`world.php?country=${country}`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error("Error:", error);
                resultDiv.innerHTML = "An error occurred while fetching data.";
            });
    });
};

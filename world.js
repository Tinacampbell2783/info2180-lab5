window.onload = function () {
    const lookupBtn = document.querySelector("#lookup");
    const lookupCitiesBtn = document.querySelector("#lookup-cities");
    const resultDiv = document.querySelector("#result");

    // Country lookup
    lookupBtn.addEventListener("click", () => {
        const country = document.querySelector("#country").value.trim();

        fetch(`world.php?country=${country}`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            });
    });

    // Cities lookup
    lookupCitiesBtn.addEventListener("click", () => {
        const country = document.querySelector("#country").value.trim();

        fetch(`world.php?country=${country}&lookup=cities`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            });
    });

};

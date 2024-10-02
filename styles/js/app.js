let sidebar = document.querySelector(".sidebar");
      let closeBtn = document.querySelector("#btn");
      let toggleBtn = document.querySelector("#toggle-btn");

      closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        mainContentShift();
      });

      toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        mainContentShift();
      });

      function mainContentShift() {
        let mainContent = document.querySelector(".main-content");
        if (sidebar.classList.contains("open")) {
          mainContent.style.marginLeft = "250px";
        } else {
          mainContent.style.marginLeft = "78px";
        }
      }
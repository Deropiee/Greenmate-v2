script.onload = () => {
  createUnityInstance(canvas, config, (progress) => {
    document.querySelector("#unity-progress-bar-full").style.width = 100 * progress + "%";
  }).then((unityInstance) => {
    document.querySelector("#unity-loading-bar").style.display = "none";
    
    const fullscreenBtn = document.querySelector("#unity-fullscreen-button");
    fullscreenBtn.onclick = () => {
      unityInstance.SetFullscreen(1);

      if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        if (screen.orientation && screen.orientation.lock) {
          screen.orientation.lock("landscape").catch(() => {
            console.log("Orientation lock failed or unsupported");
          });
        } else if (window.screen.lockOrientation) {
          window.screen.lockOrientation("landscape");
        }
      }
    };

    document.addEventListener("fullscreenchange", () => {
      if (!document.fullscreenElement) {
        if (screen.orientation && screen.orientation.unlock) {
          screen.orientation.unlock();
        }
      }
    });

  }).catch((message) => {
    alert(message);
  });
};

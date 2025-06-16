const buildUrl = "/unity/Build";
  const loaderUrl = buildUrl + "/v2.loader.js";

  const config = {
    dataUrl: buildUrl + "/v2.data",
    frameworkUrl: buildUrl + "/v2.framework.js",
    codeUrl: buildUrl + "/v2.wasm",
    streamingAssetsUrl: "StreamingAssets",
    companyName: "YourCompany",
    productName: "Green City",
    productVersion: "2.0",
  };

  const canvas = document.getElementById("unity-canvas");
  const loadingBar = document.getElementById("unity-loading-bar");
  const progressBarFull = document.getElementById("unity-progress-bar-full");
  const startButton = document.getElementById("unity-start-button");
  const fullscreenButton = document.getElementById("unity-fullscreen-button");

  // Load Unity loader script
  const script = document.createElement("script");
  script.src = loaderUrl;
  script.onload = () => {
    createUnityInstance(canvas, config, (progress) => {
      progressBarFull.style.width = (progress * 100) + "%";
    }).then((unityInstance) => {
      // Hide loading bar and show start button after loading finishes
      loadingBar.style.display = "none";
      startButton.classList.remove("hidden");

      startButton.onclick = () => {
        startButton.style.display = "none";
        canvas.classList.remove("hidden");

        // Notify Unity to drop keyboard capture
        unityInstance.SendMessage('GameObjectName', 'DisableKeyboard');
      }

      fullscreenButton.onclick = () => {
        unityInstance.SetFullscreen(1);
      };

    }).catch((e) => {
      alert(e);
    });
  };
  document.body.appendChild(script);
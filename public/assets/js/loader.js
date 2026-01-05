const GlobalLoader = {
  show() {
    document.getElementById("global-loader").style.display = "flex";
  },
  hide() {
    document.getElementById("global-loader").style.display = "none";
  },
};

document.addEventListener("DOMContentLoaded", function () {
  GlobalLoader.show();
});

window.addEventListener("load", function () {
  setTimeout(() => {
    GlobalLoader.hide();
  }, 1000);
});

if (window.jQuery) {
  console.log("===========", window.jQuery);

  $(document).ajaxStart(function () {
    GlobalLoader.show();
  });

  $(document).ajaxStop(function () {
    GlobalLoader.hide();
  });
}

const originalFetch = window.fetch;
window.fetch = function (...args) {
  GlobalLoader.show();
  return originalFetch(...args).finally(() => GlobalLoader.hide());
};

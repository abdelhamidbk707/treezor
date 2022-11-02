$(document).ready(function () {
    let toastLiveExample = document.getElementById('liveToast')

    if (toastLiveExample) {
        toastLiveExample.classList.add('show');

        $('.btn-close').on('click', function (){
            toastLiveExample.classList.remove('show');
        })
    }
});
export default function confirmDeletion() {
    const modal = document.getElementById('modal');
    const open = document.getElementsByClassName('delete-button');
    const close = document.getElementById('close');

    for (let i = 0; i < open.length; i++) {
        open[i].onclick = function () {
            modal.style.display = "block";
        }
    }

    close.onclick = function () {
        modal.style.display = "none";
    }
}
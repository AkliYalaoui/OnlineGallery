import {importBtn, modal,ordinaryFile,customFile,newFolder} from "./dom.js";

export function initiliaze(){
    window.addEventListener('load',function (){

        importBtn.addEventListener('click',function (){
            if(!document.body.classList.contains('open-import-file')){
                document.body.classList.add('open-import-file')
            }
        });

        newFolder.addEventListener('click',function (){
            if(!document.body.classList.contains('open-new-folder')){
                document.body.classList.add('open-new-folder')
            }
        });

        modal.addEventListener('click',function (e){
            if((document.body.classList.contains('open-new-folder') || document.body.classList.contains("open-import-file")) && e.target.id === "modal"){
                document.body.classList.remove('open-new-folder');
                document.body.classList.remove('open-import-file')
            }
        });

        customFile.addEventListener('click',function (){

        });
    });
}
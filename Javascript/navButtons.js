 function chiudi()
{
    javascript:document.getElementById('Descriptions').style.display='none';
}

function fullScreenView()
    {
        javascript:document.getElementById('Descriptions').style.width='99%';
        javascript:document.getElementById('Descriptions').style.height='89%';
        javascript:document.getElementById('Descriptions').style.top='2.6%';
        javascript:document.getElementById('Descriptions').style.left='0.2%';
        javascript:document.getElementById('Descriptions').style.zIndex='255';
        
        javascript:document.getElementById('restore').style.display='inline';
    }
    
    function restore()
    {
        javascript:document.getElementById('Descriptions').style.width='80%';
        javascript:document.getElementById('Descriptions').style.height='73%';
        javascript:document.getElementById('Descriptions').style.top='14.6%';
        javascript:document.getElementById('Descriptions').style.left='7.5%';
        javascript:document.getElementById('Descriptions').style.zIndex='1';
        
        javascript:document.getElementById('restore').style.display='none';
    }
 
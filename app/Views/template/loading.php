<script type='text/template' id='tmp_loader'>
    <div class="loader-inner">
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
    </div>
</script>

<style>
    .loader {
        display:none;
        bottom: 0;
        left: 0;
        overflow: hidden;
        position: fixed;
        right: 0;
        top: 0;
        z-index: 99999;
        background-color:rgb(15 43 0 / 50%)
    }
    .loader-inner {
        bottom: 0;
        height: 60px;
        left: 0;
        margin: auto;
        position: absolute;
        right: 0;
        top: 0;
        width: 100px;
    }

    .loader-line-wrap {
        animation: spin 1000ms cubic-bezier(.175, .885, .32, 1.275) infinite;
        box-sizing: border-box;
        height: 50px;
        left: 0;
        overflow: hidden;
        position: absolute;
        top: 0;
        transform-origin: 50% 100%;
        width: 100px;
    }
    .loader-line {
        border: 4px solid transparent;
        border-radius: 100%;
        box-sizing: border-box;
        height: 100px;
        left: 0;
        margin: 0 auto;
        position: absolute;
        right: 0;
        top: 0;
        width: 100px;
    }
    .loader-line-wrap:nth-child(1) { animation-delay: -50ms; }
    .loader-line-wrap:nth-child(2) { animation-delay: -100ms; }
    .loader-line-wrap:nth-child(3) { animation-delay: -150ms; }
    .loader-line-wrap:nth-child(4) { animation-delay: -200ms; }
    .loader-line-wrap:nth-child(5) { animation-delay: -250ms; }

    .loader-line-wrap:nth-child(1) .loader-line {
        border-color: hsl(0, 80%, 60%);
        height: 90px;
        width: 90px;
        top: 7px;
    }
    .loader-line-wrap:nth-child(2) .loader-line {
        border-color: hsl(60, 80%, 60%);
        height: 76px;
        width: 76px;
        top: 14px;
    }
    .loader-line-wrap:nth-child(3) .loader-line {
        border-color: hsl(120, 80%, 60%);
        height: 62px;
        width: 62px;
        top: 21px;
    }
    .loader-line-wrap:nth-child(4) .loader-line {
        border-color: hsl(180, 80%, 60%);
        height: 48px;
        width: 48px;
        top: 28px;
    }
    .loader-line-wrap:nth-child(5) .loader-line {
        border-color: hsl(240, 80%, 60%);
        height: 34px;
        width: 34px;
        top: 35px;
    }

    @keyframes spin {
        0%, 15% {
            transform: rotate(0);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script type='text/javascript'>
    var loading = (function(){
        var status = void 0;
        var element = void 0;
        var loader = void 0;
        var tmp = {};
        const Show = function(out=false){
            if(out){
                element = document.createElement('div');
                element.setAttribute('id', 'loading_msj');
                $(element).html("<div class='loading_msj'><p class='text-warning'>Procesando datos de busqueda...</p></div>");
                document.getElementById('app').appendChild(element);
            }
            if(!status){
                tmp.loading = _.template($('#tmp_loader').html());
                loader = document.createElement('div');
                loader.setAttribute('class','loader');
                loader.setAttribute('id','loader');
                $(loader).append(tmp.loading());
                document.body.appendChild(loader);
                loader.setAttribute('style','display:block');
            }
            status = true;
        };
        const Hide = function(out=false){
            if(out){
                element.remove();
            }
            if(status){
                loader.remove();
            }
            status = void 0;
        };
        return {
            "hide":Hide,
            "show":Show
        }
    })();
</script>
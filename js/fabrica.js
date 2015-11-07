/* 
    Created on : 24/09/2015, 19:52:56
    Author     : Gabriel Lopes
*/
$(document).ready(function(){

    $('#index2').click(function(){
    var nome = $('#login1').val(),
        pass = $('#login2').val();
        $.ajax({
            method: "POST",
            url: "login.php",
            data: {login: nome, senha: pass},
            beforeSend:"",
            error: "",
            success: function(r){
                if(r === 'nao autenticado'){
            $("#index3").empty().html("<p>Login ou senha inválido!!!</p>").fadeIn('slow');
                    window.setTimeout(function(){
                    $("#index3").fadeOut('slow');
                },2000);
                }else if(r === 'autenticado'){
            $("#index3").empty().html("<p>Efetuando autenticação...</p><img src='img/load-login.gif'</p>").fadeIn('slow');
                    window.setTimeout(function(){
                    $("#index3").fadeOut('slow');
                    $("#index3").css('display','none');
                    $(location).attr('href','home.php');
                },2000);
                }else if(r === 'login'){
            $("#index3").empty().html("<p>Campo login vazio.</p>").fadeIn('slow');
                    window.setTimeout(function(){
                    $("#index3").fadeOut('slow');
                    $("#index3").css('display','none');
                },2000);
                }else if(r === 'senha'){
            $("#index3").empty().html("<p>Campo senha vazio.</p>").fadeIn('slow');
                    window.setTimeout(function(){
                    $("#index3").fadeOut('slow');
                    $("#index3").css('display','none');
                },2000);
                }
            }
        });
        return false;
     });
     
     $("#menu1 a[href$='#32'], #menu1 a[href$='#33']").click(function(){
        $.ajax({
            method: "POST",
            url: "alteraselec.php",
            success: function(r){
                $("#alter .sistema, #exclui .sistema").html(r);}
        });
     });
     
     var ponteiro;
     $("#menu1 a[href$='#32']").click(function(){
         if(ponteiro !== '#32'){
             $("#cadastro").slideUp(900);
             $("#exclui").slideUp(900);
             $("#alter").slideDown();
         }else{
            $("#alter").slideDown(); }
            ponteiro = $("#menu1 .alt").find("a").attr('href');
            $("#menu1 ul ul li").hide();
     });
     
     $("#menu1 a[href$='#31']").click(function(){
         if(ponteiro !== '#31'){
             $("#alter").slideUp(900);
             $("#exclui").slideUp(900);
             $("#cadastro").slideDown();
         }else{
            $("#cadastro").slideDown(); }
            ponteiro = $("#menu1 .cad").find("a").attr('href');
            $("#menu1 ul ul li").hide();
     });
     
     $("#menu1 a[href$='#33']").click(function(){
         if(ponteiro !== '#33'){
             $("#alter").slideUp(900);
             $("#cadastro").slideUp(900);
             $("#exclui").slideDown();
         }else{
             $("#exclui").slideDown(); }
            ponteiro = $("#menu1 .exc").find("a").attr('href');
            $("#menu1 ul ul li").hide();
     });
     
    $("#menu1 ul").mouseover(function(){
        $("#menu1 ul ul li").show();
    });
     
    $("#alter .botao").click(function(){
            $("#alter").slideUp();
    });
    
    $("#cadastro .cadbotao").click(function(){
            $("#cadastro").slideUp();
    });
    
    $("#exclui .excbotao").click(function(){
            $("#exclui").slideUp();
    });
     
     var sys;
     $("#exclui .sistema, #alter .sistema").click(function(){
        if(ponteiro === '#33'){
             sys = $("#exclui .sistema option:selected").val();
        }else{
             sys = $("#alter .sistema option:selected").val();
         }
            $.ajax({
                method: "POST",
                data: {id: sys},
                dataType: "json",
                url: "alteraselec.php",
                beforeSend: "",
                error: "",
                success: function(r){
                    $.each(r, function(k, v){
                        $("#exclui form").find("input[name="+k+"]").val(v);
                        $("#alter form").find("input[name="+k+"]").val(v);
                    });
                }
            });
     });

     $("#alter form").submit(function(e){
        var id = $(".id").val(), ip = $(".ip").val(), 
            porta = $(".porta").val();
            $.ajax({
                method: "POST",
                data: {id: id, ip: ip, porta: porta},
                url: "altera.php",
                beforeSend: "",
                error: "",
                success: function(r){
                    $("#altermsg").html("<span>"+r+"</span>").fadeIn('slow');
                    window.setTimeout(function(){
                    $("#altermsg").fadeOut('slow');
                },2000); }   
               });
            e.preventDefault();
        });
        
     $("#menu1 input").click(function(){
        $("#conteudo2").empty();
        $.post('tabelafront.php',{sys: sys},function(r){
        $("#conteudo2").html(r);
        });
        var i = 0, sys;
        setInterval(function(){
        if($("#menu1 input").is(":checked")){
                i++;
            $.ajax({
                method: "POST",
                data: {id: i},
                dataType: "json",
                url: "tabela.php",
                beforeSend: "",
                error: "",
                success: function(r){
                $.each(r, function(k, v){
                    if(v === 'Vazio'){
                        i = 0;
                    }else{
                        sys = v;
                    }
                    });
                }
            });
            $.post('tabelafront.php',{sys: sys},function(r){
                $("#conteudo2").html(r);
            });
        }
            },2000);   
    });
    
     $("#menu1 input").click(function(){
         
       var i = 0, sys;
        setInterval(function(){
        if($("#menu1 input").is(":checked")){
                i++;
            $.ajax({
                method: "POST",
                data: {id: i},
                dataType: "json",
                url: "tabela.php",
                beforeSend: "",
                error: "",
                success: function(r){
                $.each(r, function(k, v){
                    if(v === 'Vazio'){
                        i = 0;
                    }else{
                        sys = v;
                    }
                    });
                }
            });
            $.post('tabelarota.php',{sys: sys},function(r){
                $("#conteudo0").html(r);
            });
        }
            },800);    
    });
    
     $("#cadastro form").submit(function(e){
        var sistema = $(".cadsistema").val(), ip = $(".cadip").val(), 
            porta = $(".cadporta").val();
            $.ajax({
                method: "POST",
                data: {sistema: sistema, ip: ip, porta: porta},
                url: "cadastro.php",
                beforeSend: "",
                error: "",
                success: function(r){
                    $("#cadmsg").html("<span>"+r+"</span>").fadeIn('slow');
                    window.setTimeout(function(){
                    $("#cadmsg").fadeOut('slow');
                },2000); }
            });
            e.preventDefault();
        });
        
     $("#exclui form").submit(function(e){
        var sistema = $(".excid").val();
            if(sistema === ''){
                return false;
            }
            $.ajax({
                method: "POST",
                data: {id: sistema},
                url: "exclui.php",
                beforeSend: "",
                error: "",
                success: function(r){
                    $("").empty();
                    $("#excmsg").html("<span>"+r+"</span>").fadeIn('slow');
                    window.setTimeout(function(){
                    $("#excmsg").fadeOut('slow');
                },2000); }
            });
            e.preventDefault();
        });
        
     $("#menu1 a[href$='#30']").on('click',(function(){
            $.ajax({
              url: "home1.php",
              cache: false
            }).done(function(r){
              $("#conteudo2").html(r);
              $("#conteudo2").addClass("dashboard");
            });
        }));
        
     $("#conteudo2").on({
            mouseenter: function(e){
            var idd = e.target.id;
            console.log(idd);
              $(this).css({'font-weight': 'bold'});
            $.ajax({
                method: "POST",
                url: "home1.php",
                data: {id: idd},
                beforeSend:"",
                error: "",
                success: function(r){
                    $("#conteudo0").html(r);
                }
                });
            },
            mouseleave: function(){
              $(this).css({'font-weight': 'normal'});
            }
     },'span ol');
        
});



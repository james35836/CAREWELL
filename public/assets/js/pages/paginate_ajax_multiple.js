var paginate_ajax = new paginate_ajax();
            
function paginate_ajax()
{
	init();
	function init()
	{
		$(document).ready(function()
		{
			document_ready();
            
		});
	}
	
	function document_ready()
	{
	    event_run_paginate();
    }
	this.toLocation = function(url) 
    {
        var a = document.createElement('a');
        a.href = url;
        return a;
    };
	function event_run_paginate()
    {
        $('body').on('click', '.paginations a', function(e) 
        {
            e.preventDefault();
            var href= $(this).data('href');
            var url = paginate_ajax.toLocation(href);
            var domain = url.protocol + "//" + url.hostname;
            
            var load_data = $(this).closest('.load-data');
            
            load_data.find('tr').css('opacity', '0.2');
            
            if (window.location.href.indexOf("https") != -1)
            {
                var url = $(this).attr('href').replace("http", "https");
            }
            else
            {
                var url = $(this).attr('href');
            }

            load_data.each(function() 
            {
                $.each(this.attributes, function() 
                {
                    if(this.specified && this.name != "class" && this.name != "style") 
                    {
                        url = href.replace(domain,'');
                    }
                });
            });
            getArticles(url, load_data);
        });
    }

    function getArticles(url, load_data) 
    {
        target = load_data.data("target");
        console.log(target);
        load_data.load(url+" div."+target, function()
        {
            if (typeof loading_done == 'function')
            {
                
            }
        })
    }
}
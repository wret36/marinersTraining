function Pager(tableName, itemsPerPage) {
    this.tableName = tableName;
    this.itemsPerPage = itemsPerPage;
    this.currentPage = 1;
    this.pages = 0;
    this.inited = false;
    
    this.showRecords = function(from, to) {        
        var rows = document.getElementById(tableName).rows;
        // i starts from 1 to skip table header row
        for (var i = 1; i < rows.length; i++) {
            if (i < from || i > to)  
                rows[i].style.display = 'none';
            else
                rows[i].style.display = '';
        }
    }
    
    this.showPage = function(pageNumber) {
    	if (! this.inited) {
    		alert("paging not initiated");
    		return;
    	}

        var oldPageAnchor = document.getElementById('pg'+this.currentPage);
        oldPageAnchor.className = 'pg-normal';
        
        this.currentPage = pageNumber;
        var newPageAnchor = document.getElementById('pg'+this.currentPage);
        newPageAnchor.className = 'pg-selected';
        
        var from = (pageNumber - 1) * itemsPerPage + 1;
        var to = from + itemsPerPage - 1;
        this.showRecords(from, to);
        
        this.adjustPagination();
    }   
    
    this.prev = function() {
        if (this.currentPage > 1)
            this.showPage(this.currentPage - 1);
    }
    
    this.next = function() {
        if (this.currentPage < this.pages) {
            this.showPage(this.currentPage + 1);
        }
    }                        
    
    this.init = function() {
        var rows = document.getElementById(this.tableName).rows;
        var records = (rows.length - 1); 
        this.pages = Math.ceil(records / itemsPerPage);
        this.inited = true;
    }

    this.showPageNav = function(pagerName, positionId) {
    	if (! this.inited) {
    		alert("paging not initiated");
    		return;
    	}
    	var element = document.getElementById(positionId);
    	var display = "";
    	var page = 0;
    	
    	var pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal"> &#171 Prev </span>  ';
        for (var page = 1; page <= this.pages; page++) 
        	if (page > 5) {
        		pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');" style="display: none">' + page + ' </span> ';
        	} else {
        		pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span> ';
        	}
//        	pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span> | ';
        pagerHtml += '<span onclick="'+pagerName+'.next();" class="pg-normal"> Next &#187;</span>';            
        
        element.innerHTML = pagerHtml;
    }
    
    this.adjustPagination = function() {
    	var page = 0;
    		var pagesFromLeft = this.currentPage - 2;
    		var pagesFromRight = this.currentPage + 2;
    		for (page = 1; page <= this.pages ; page++) {
    			if (this.currentPage <= 3) {
    				if (page < 6) {
    					document.getElementById('pg' + page).style.display = "inline";
    				} else {
    					document.getElementById('pg' + page).style.display = "none";
    				}
    			} else if (this.currentPage > 3 && this.currentPage < (this.pages - 3)) {
    				if (page < pagesFromLeft) {
    					document.getElementById('pg' + page).style.display = "none";
    				} else if (page > pagesFromRight){
    					document.getElementById('pg' + page).style.display = "none";
    				} else {
    					document.getElementById('pg' + page).style.display = "inline";
    				}
    			} else if (this.currentPage >= (this.pages - 2)) {
    				if (page > (this.pages - 5)) {
    					document.getElementById('pg' + page).style.display = "inline";
    				} else {
    					document.getElementById('pg' + page).style.display = "none";
    				}
    			}
    		}
    }
}


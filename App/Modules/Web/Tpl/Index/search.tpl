<!--{include file="../Common/header.tpl"}-->
<style type="text/css">
	h1 {font-weight:100; margin-top:0px;}
	a:hover {text-decoration:none;}
</style>
<body>
<div id="wrapper">
	<!----{顶部搜索框}---->
	<div class="searchbox clearfix" style="width:100%;">
        <a href="/" class="fl ml15"><h1><font color="#6E329D">Seek About</font></h1></a>
        <div class="search fl " id="search-result-bar">
            <form method="get" action="/index/search" onsubmit="return searchutil.format();">
                <input type="text" name="q" value="<!--{$keyword}-->" class="pure-input-rounded" style="float:left;width:490px;height:25px;" autofocus="true" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" aria-haspopup="true" aria-combobox="list" role="combobox">
				<button type="submit" class="pure-button pure-button-primary" style="float:left;height:35px;margin-left:5px;">Search</button>
            </form>
        </div>
		<div class="advance fl" style="padding-left:20px;"></div>
		 <!--{if $totalnum != 0}--><p class="search-result-num">找到约<!--{$total_found}-->条结果</p><!--{/if}-->
    </div>
    
    <!---{搜索结果}---->
    <div class="clearfix" id="result">
        <div class="fl" id="main" style="float:left;margin-left:-45px;">
        	<!--{if $totalnum != 0}-->
            <dl>
                <dd id="zhaiyao">
	                	<!--{foreach from=$real_datas item=val key=key}-->
							<ul>
		                        <li><a class="title pic" href="<!--{$val.url.0}-->" target="_blank"><!--{$val.title.0}--></a></li>
		                        <li class="content">
									<!--{$val.des.0}-->
								</li>
		                        <li class="author">
		                        	<span><!--{$val.url.0}--> 发表于 <!--{$val.create_time.0|date_format:"%Y-%m-%d %H:%M:%S"}--></span>
		                            <span id="score">价格:<!--{$val.price.0}--></span>
		                        </li>
		                    </ul>
		                <!--{/foreach}-->
				 </dd>
            </dl>
            <div class="pure-paginator" style="float:left;margin-left:70px;">
				<!--{$pagination}-->
			</div>
		    <!--{else}-->
			    <dd id="zhaiyao">
			    	<ul>
		           		<li><h2>Sorry，Not Found Any Content About this <font color="#D50000"><!--{$keyword}--></font> Keyword.</h2></li>
		           	</ul>
		        </dd>
	        <!--{/if}-->
        </div>
        
        <!---{右侧广告显示}--->
        <div class="fl w252" id="search_result">
        	<div class="adv200x150">
				<ul>
					<li></li>
				</ul>
			</div>
			<dl class="right_search" style="display:block;">
				<dt class="clearfix"><span class="fl">advertising promotion</span><span class="fr"><a target="_blank" href="http://search.jobmd.cn/">More</a></span></dt>
                <dd>
                    <dl id="oth_search_jobmd">
                    </dl>
                </dd>
                <dd class="line"></dd>
            </dl>
            <dl class="right_search" style="display:block;margin-top:10px;">
                <dt class="clearfix"><span class="fl">品牌推广</span><span class="fr"><a target="_blank" href="http://www.biomart.cn/product/heihei">More</a></span></dt>
                <dd>
                    <dl id="oth_search_tong">
                    </dl>
                </dd>
                <dd class="line"></dd>
            </dl>
       </div>
    </div>
    
    <!----{相关搜索结果}---->
    <div class="clearfix" id="relate" style="width:100%; float:left;margin-left:-160px;">
    	<div class="field fl" style="float:left;">相关搜索：</div>
        <div class="fl relatec" id="relatec" style="float:left;">
        	<!--{foreach from=$likekeyword key=key item=val}-->
        		<!--{if $key == 4}-->
        			<span><a href="/index/search/?q=<!--{$val.keyword}-->"><!--{$val.keyword}--></a></span><br />
        		<!--{else}-->
        			<span><a href="/index/search/?q=<!--{$val.keyword}-->"><!--{$val.keyword}--></a></span>
        		<!--{/if}-->
        	<!--{/foreach}-->
        </div>
    </div>
    
    <!----{底部搜索框}---->
    <div class="searchbox-foot" style="width:100%; float:left; margin-left:25px;">
		<form method="get" action="/index/search" onsubmit="return searchutil.format();">
            <input type="text" name="q" value="<!--{$keyword}-->" class="pure-input-rounded" style="float:left;width:490px;height:25px;" autofocus="true" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" aria-haspopup="true" aria-combobox="list" role="combobox">
			<button type="submit" class="pure-button pure-button-primary" style="float:left;height:35px;margin-left:5px;">Search</button>
        </form>
    </div>
    
    <!---{底部版权信息}---->
    <div style="float:left; margin-left:25px; margin-top:10px;">&copy;niansong-2013, this is a sphinx test demo website, thank you for use it</div>
</div>
</body>
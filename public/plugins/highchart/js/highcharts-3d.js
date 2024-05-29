/*
 Highcharts JS v5.0.12 (2017-05-24)

 3D features for Highcharts JS

 @license: www.highcharts.com/license
*/
(function(z){"object"===typeof module&&module.exports?module.exports=z:z(Highcharts)})(function(z){(function(d){var r=d.deg2rad,v=d.pick;d.perspective=function(w,x,t){var l=x.options.chart.options3d,h=t?x.inverted:!1,f=x.plotWidth/2,m=x.plotHeight/2,u=l.depth/2,c=v(l.depth,1)*v(l.viewDistance,0),a=x.scale3d||1,b=r*l.beta*(h?-1:1),l=r*l.alpha*(h?-1:1),e=Math.cos(l),g=Math.cos(-b),k=Math.sin(l),A=Math.sin(-b);t||(f+=x.plotLeft,m+=x.plotTop);return d.map(w,function(b){var d,q;q=(h?b.y:b.x)-f;var p=(h?
b.x:b.y)-m,G=(b.z||0)-u;d=g*q-A*G;b=-k*A*q+e*p-g*k*G;q=e*A*q+k*p+e*g*G;p=0<c&&c<Number.POSITIVE_INFINITY?c/(q+u+c):1;d=d*p*a+f;b=b*p*a+m;return{x:h?b:d,y:h?d:b,z:q*a+u}})};d.pointCameraDistance=function(d,r){var t=r.options.chart.options3d,l=r.plotWidth/2;r=r.plotHeight/2;t=v(t.depth,1)*v(t.viewDistance,0)+t.depth;return Math.sqrt(Math.pow(l-d.plotX,2)+Math.pow(r-d.plotY,2)+Math.pow(t-d.plotZ,2))};d.shapeArea=function(d){var r=0,t,l;for(t=0;t<d.length;t++)l=(t+1)%d.length,r+=d[t].x*d[l].y-d[l].x*
d[t].y;return r/2};d.shapeArea3d=function(r,v,t){return d.shapeArea(d.perspective(r,v,t))}})(z);(function(d){function r(a,e,b,d,c,k,g,m){var B=[],p=k-c;return k>c&&k-c>Math.PI/2+.0001?(B=B.concat(r(a,e,b,d,c,c+Math.PI/2,g,m)),B=B.concat(r(a,e,b,d,c+Math.PI/2,k,g,m))):k<c&&c-k>Math.PI/2+.0001?(B=B.concat(r(a,e,b,d,c,c-Math.PI/2,g,m)),B=B.concat(r(a,e,b,d,c-Math.PI/2,k,g,m))):["C",a+b*Math.cos(c)-b*q*p*Math.sin(c)+g,e+d*Math.sin(c)+d*q*p*Math.cos(c)+m,a+b*Math.cos(k)+b*q*p*Math.sin(k)+g,e+d*Math.sin(k)-
d*q*p*Math.cos(k)+m,a+b*Math.cos(k)+g,e+d*Math.sin(k)+m]}var v=Math.cos,w=Math.PI,x=Math.sin,t=d.animObject,l=d.charts,h=d.color,f=d.defined,m=d.deg2rad,u=d.each,c=d.extend,a=d.inArray,b=d.map,e=d.merge,g=d.perspective,k=d.pick,A=d.SVGElement,y=d.SVGRenderer,n=d.wrap,q=4*(Math.sqrt(2)-1)/3/(w/2);n(y.prototype,"init",function(a){a.apply(this,[].slice.call(arguments,1));u([{name:"darker",slope:.6},{name:"brighter",slope:1.4}],function(a){this.definition({tagName:"filter",id:"highcharts-"+a.name,children:[{tagName:"feComponentTransfer",
children:[{tagName:"feFuncR",type:"linear",slope:a.slope},{tagName:"feFuncG",type:"linear",slope:a.slope},{tagName:"feFuncB",type:"linear",slope:a.slope}]}]})},this)});y.prototype.toLinePath=function(a,b){var e=[];u(a,function(a){e.push("L",a.x,a.y)});a.length&&(e[0]="M",b&&e.push("Z"));return e};y.prototype.toLineSegments=function(a){var e=[],b=!0;u(a,function(a){e.push(b?"M":"L",a.x,a.y);b=!b});return e};y.prototype.face3d=function(a){var e=this,b=this.createElement("path");b.vertexes=[];b.insidePlotArea=
!1;b.enabled=!0;n(b,"attr",function(a,b){if("object"===typeof b&&(f(b.enabled)||f(b.vertexes)||f(b.insidePlotArea))){this.enabled=k(b.enabled,this.enabled);this.vertexes=k(b.vertexes,this.vertexes);this.insidePlotArea=k(b.insidePlotArea,this.insidePlotArea);delete b.enabled;delete b.vertexes;delete b.insidePlotArea;var c=g(this.vertexes,l[e.chartIndex],this.insidePlotArea),B=e.toLinePath(c,!0),c=d.shapeArea(c),c=this.enabled&&0<c?"visible":"hidden";b.d=B;b.visibility=c}return a.apply(this,[].slice.call(arguments,
1))});n(b,"animate",function(b,a){if("object"===typeof a&&(f(a.enabled)||f(a.vertexes)||f(a.insidePlotArea))){this.enabled=k(a.enabled,this.enabled);this.vertexes=k(a.vertexes,this.vertexes);this.insidePlotArea=k(a.insidePlotArea,this.insidePlotArea);delete a.enabled;delete a.vertexes;delete a.insidePlotArea;var c=g(this.vertexes,l[e.chartIndex],this.insidePlotArea),B=e.toLinePath(c,!0),c=d.shapeArea(c),c=this.enabled&&0<c?"visible":"hidden";a.d=B;this.attr("visibility",c)}return b.apply(this,[].slice.call(arguments,
1))});return b.attr(a)};y.prototype.polyhedron=function(a){var b=this,e=this.g(),c=e.destroy;e.faces=[];e.destroy=function(){for(var a=0;a<e.faces.length;a++)e.faces[a].destroy();return c.call(this)};n(e,"attr",function(a,c,d,k,g){if("object"===typeof c&&f(c.faces)){for(;e.faces.length>c.faces.length;)e.faces.pop().destroy();for(;e.faces.length<c.faces.length;)e.faces.push(b.face3d().add(e));for(var B=0;B<c.faces.length;B++)e.faces[B].attr(c.faces[B],null,k,g);delete c.faces}return a.apply(this,[].slice.call(arguments,
1))});n(e,"animate",function(a,c,d,k){if(c&&c.faces){for(;e.faces.length>c.faces.length;)e.faces.pop().destroy();for(;e.faces.length<c.faces.length;)e.faces.push(b.face3d().add(e));for(var g=0;g<c.faces.length;g++)e.faces[g].animate(c.faces[g],d,k);delete c.faces}return a.apply(this,[].slice.call(arguments,1))});return e.attr(a)};y.prototype.cuboid=function(a){var e=this.g(),b=e.destroy;a=this.cuboidPath(a);e.front=this.path(a[0]).attr({"class":"highcharts-3d-front"}).add(e);e.top=this.path(a[1]).attr({"class":"highcharts-3d-top"}).add(e);
e.side=this.path(a[2]).attr({"class":"highcharts-3d-side"}).add(e);e.fillSetter=function(a){this.front.attr({fill:a});this.top.attr({fill:h(a).brighten(.1).get()});this.side.attr({fill:h(a).brighten(-.1).get()});this.color=a;return this};e.opacitySetter=function(a){this.front.attr({opacity:a});this.top.attr({opacity:a});this.side.attr({opacity:a});return this};e.attr=function(a,e){if("string"===typeof a&&"undefined"!==typeof e){var b=a;a={};a[b]=e}if(a.shapeArgs||f(a.x))a=this.renderer.cuboidPath(a.shapeArgs||
a),this.front.attr({d:a[0]}),this.top.attr({d:a[1]}),this.side.attr({d:a[2]});else return d.SVGElement.prototype.attr.call(this,a);return this};e.animate=function(a,e,b){f(a.x)&&f(a.y)?(a=this.renderer.cuboidPath(a),this.front.animate({d:a[0]},e,b),this.top.animate({d:a[1]},e,b),this.side.animate({d:a[2]},e,b),this.attr({zIndex:-a[3]})):a.opacity?(this.front.animate(a,e,b),this.top.animate(a,e,b),this.side.animate(a,e,b)):A.prototype.animate.call(this,a,e,b);return this};e.destroy=function(){this.front.destroy();
this.top.destroy();this.side.destroy();return b.call(this)};e.attr({zIndex:-a[3]});return e};d.SVGRenderer.prototype.cuboidPath=function(a){function e(a){return r[a]}var c=a.x,k=a.y,m=a.z,u=a.height,p=a.width,A=a.depth,q=l[this.chartIndex],n,y,f=q.options.chart.options3d.alpha,h=0,r=[{x:c,y:k,z:m},{x:c+p,y:k,z:m},{x:c+p,y:k+u,z:m},{x:c,y:k+u,z:m},{x:c,y:k+u,z:m+A},{x:c+p,y:k+u,z:m+A},{x:c+p,y:k,z:m+A},{x:c,y:k,z:m+A}],r=g(r,q,a.insidePlotArea);y=function(a,c){var k=[[],-1];a=b(a,e);c=b(c,e);0>d.shapeArea(a)?
k=[a,0]:0>d.shapeArea(c)&&(k=[c,1]);return k};n=y([3,2,1,0],[7,6,5,4]);a=n[0];p=n[1];n=y([1,6,7,0],[4,5,2,3]);u=n[0];A=n[1];n=y([1,2,5,6],[0,7,4,3]);y=n[0];n=n[1];1===n?h+=1E4*(1E3-c):n||(h+=1E4*c);h+=10*(!A||0<=f&&180>=f||360>f&&357.5<f?q.plotHeight-k:10+k);1===p?h+=100*m:p||(h+=100*(1E3-m));h=-Math.round(h);return[this.toLinePath(a,!0),this.toLinePath(u,!0),this.toLinePath(y,!0),h]};d.SVGRenderer.prototype.arc3d=function(b){function d(b){var c=!1,g={};b=e(b);for(var k in b)-1!==a(k,q)&&(g[k]=b[k],
delete b[k],c=!0);return c?g:!1}var g=this.g(),p=g.renderer,q="x y r innerR start end".split(" ");b=e(b);b.alpha*=m;b.beta*=m;g.top=p.path();g.side1=p.path();g.side2=p.path();g.inn=p.path();g.out=p.path();g.onAdd=function(){var a=g.parentGroup,e=g.attr("class");g.top.add(g);u(["out","inn","side1","side2"],function(b){g[b].addClass(e+" highcharts-3d-side").add(a)})};g.setPaths=function(a){var e=g.renderer.arc3dPath(a),b=100*e.zTop;g.attribs=a;g.top.attr({d:e.top,zIndex:e.zTop});g.inn.attr({d:e.inn,
zIndex:e.zInn});g.out.attr({d:e.out,zIndex:e.zOut});g.side1.attr({d:e.side1,zIndex:e.zSide1});g.side2.attr({d:e.side2,zIndex:e.zSide2});g.zIndex=b;g.attr({zIndex:b});a.center&&(g.top.setRadialReference(a.center),delete a.center)};g.setPaths(b);g.fillSetter=function(a){var e=h(a).brighten(-.1).get();this.fill=a;this.side1.attr({fill:e});this.side2.attr({fill:e});this.inn.attr({fill:e});this.out.attr({fill:e});this.top.attr({fill:a});return this};u(["opacity","translateX","translateY","visibility"],
function(a){g[a+"Setter"]=function(a,e){g[e]=a;u(["out","inn","side1","side2","top"],function(b){g[b].attr(e,a)})}});n(g,"attr",function(a,e){var b;"object"===typeof e&&(b=d(e))&&(c(g.attribs,b),g.setPaths(g.attribs));return a.apply(this,[].slice.call(arguments,1))});n(g,"animate",function(a,b,c,g){var m,u=this.attribs,p;delete b.center;delete b.z;delete b.depth;delete b.alpha;delete b.beta;p=t(k(c,this.renderer.globalAnimation));p.duration&&(m=d(b),b.dummy=1,m&&(p.step=function(a,b){function c(a){return u[a]+
(k(m[a],u[a])-u[a])*b.pos}"dummy"===b.prop&&b.elem.setPaths(e(u,{x:c("x"),y:c("y"),r:c("r"),innerR:c("innerR"),start:c("start"),end:c("end")}))}),c=p);return a.call(this,b,c,g)});g.destroy=function(){this.top.destroy();this.out.destroy();this.inn.destroy();this.side1.destroy();this.side2.destroy();A.prototype.destroy.call(this)};g.hide=function(){this.top.hide();this.out.hide();this.inn.hide();this.side1.hide();this.side2.hide()};g.show=function(){this.top.show();this.out.show();this.inn.show();this.side1.show();
this.side2.show()};return g};y.prototype.arc3dPath=function(a){function e(a){a%=2*Math.PI;a>Math.PI&&(a=2*Math.PI-a);return a}var b=a.x,c=a.y,g=a.start,k=a.end-.00001,d=a.r,m=a.innerR,u=a.depth,n=a.alpha,p=a.beta,A=Math.cos(g),q=Math.sin(g);a=Math.cos(k);var y=Math.sin(k),f=d*Math.cos(p),d=d*Math.cos(n),h=m*Math.cos(p),l=m*Math.cos(n),m=u*Math.sin(p),t=u*Math.sin(n),u=["M",b+f*A,c+d*q],u=u.concat(r(b,c,f,d,g,k,0,0)),u=u.concat(["L",b+h*a,c+l*y]),u=u.concat(r(b,c,h,l,k,g,0,0)),u=u.concat(["Z"]),z=
0<p?Math.PI/2:0,p=0<n?0:Math.PI/2,z=g>-z?g:k>-z?-z:g,C=k<w-p?k:g<w-p?w-p:k,D=2*w-p,n=["M",b+f*v(z),c+d*x(z)],n=n.concat(r(b,c,f,d,z,C,0,0));k>D&&g<D?(n=n.concat(["L",b+f*v(C)+m,c+d*x(C)+t]),n=n.concat(r(b,c,f,d,C,D,m,t)),n=n.concat(["L",b+f*v(D),c+d*x(D)]),n=n.concat(r(b,c,f,d,D,k,0,0)),n=n.concat(["L",b+f*v(k)+m,c+d*x(k)+t]),n=n.concat(r(b,c,f,d,k,D,m,t)),n=n.concat(["L",b+f*v(D),c+d*x(D)]),n=n.concat(r(b,c,f,d,D,C,0,0))):k>w-p&&g<w-p&&(n=n.concat(["L",b+f*Math.cos(C)+m,c+d*Math.sin(C)+t]),n=n.concat(r(b,
c,f,d,C,k,m,t)),n=n.concat(["L",b+f*Math.cos(k),c+d*Math.sin(k)]),n=n.concat(r(b,c,f,d,k,C,0,0)));n=n.concat(["L",b+f*Math.cos(C)+m,c+d*Math.sin(C)+t]);n=n.concat(r(b,c,f,d,C,z,m,t));n=n.concat(["Z"]);p=["M",b+h*A,c+l*q];p=p.concat(r(b,c,h,l,g,k,0,0));p=p.concat(["L",b+h*Math.cos(k)+m,c+l*Math.sin(k)+t]);p=p.concat(r(b,c,h,l,k,g,m,t));p=p.concat(["Z"]);A=["M",b+f*A,c+d*q,"L",b+f*A+m,c+d*q+t,"L",b+h*A+m,c+l*q+t,"L",b+h*A,c+l*q,"Z"];b=["M",b+f*a,c+d*y,"L",b+f*a+m,c+d*y+t,"L",b+h*a+m,c+l*y+t,"L",b+h*
a,c+l*y,"Z"];y=Math.atan2(t,-m);c=Math.abs(k+y);a=Math.abs(g+y);g=Math.abs((g+k)/2+y);c=e(c);a=e(a);g=e(g);g*=1E5;k=1E5*a;c*=1E5;return{top:u,zTop:1E5*Math.PI+1,out:n,zOut:Math.max(g,k,c),inn:p,zInn:Math.max(g,k,c),side1:A,zSide1:.99*c,side2:b,zSide2:.99*k}}})(z);(function(d){function r(d,u){var c=d.plotLeft,a=d.plotWidth+c,b=d.plotTop,e=d.plotHeight+b,g=c+d.plotWidth/2,k=b+d.plotHeight/2,m=Number.MAX_VALUE,f=-Number.MAX_VALUE,n=Number.MAX_VALUE,q=-Number.MAX_VALUE,p,h=1;p=[{x:c,y:b,z:0},{x:c,y:b,
z:u}];w([0,1],function(b){p.push({x:a,y:p[b].y,z:p[b].z})});w([0,1,2,3],function(a){p.push({x:p[a].x,y:e,z:p[a].z})});p=t(p,d,!1);w(p,function(a){m=Math.min(m,a.x);f=Math.max(f,a.x);n=Math.min(n,a.y);q=Math.max(q,a.y)});c>m&&(h=Math.min(h,1-Math.abs((c+g)/(m+g))%1));a<f&&(h=Math.min(h,(a-g)/(f-g)));b>n&&(h=0>n?Math.min(h,(b+k)/(-n+b+k)):Math.min(h,1-(b+k)/(n+k)%1));e<q&&(h=Math.min(h,Math.abs((e-k)/(q-k))));return h}var v=d.Chart,w=d.each,x=d.merge,t=d.perspective,l=d.pick,h=d.wrap;v.prototype.is3d=
function(){return this.options.chart.options3d&&this.options.chart.options3d.enabled};v.prototype.propsRequireDirtyBox.push("chart.options3d");v.prototype.propsRequireUpdateSeries.push("chart.options3d");d.wrap(d.Chart.prototype,"isInsidePlot",function(d){return this.is3d()||d.apply(this,[].slice.call(arguments,1))});var f=d.getOptions();x(!0,f,{chart:{options3d:{enabled:!1,alpha:0,beta:0,depth:100,fitToPlot:!0,viewDistance:25,axisLabelPosition:"default",frame:{visible:"default",size:1,bottom:{},
top:{},left:{},right:{},back:{},front:{}}}}});h(v.prototype,"getContainer",function(d){d.apply(this,[].slice.call(arguments,1));this.renderer.definition({tagName:"style",textContent:".highcharts-3d-top{filter: url(#highcharts-brighter)}\n.highcharts-3d-side{filter: url(#highcharts-darker)}\n"})});h(v.prototype,"setClassName",function(d){d.apply(this,[].slice.call(arguments,1));this.is3d()&&(this.container.className+=" highcharts-3d-chart")});d.wrap(d.Chart.prototype,"setChartSize",function(d){var m=
this.options.chart.options3d;d.apply(this,[].slice.call(arguments,1));if(this.is3d()){var c=this.inverted,a=this.clipBox,b=this.margin;a[c?"y":"x"]=-(b[3]||0);a[c?"x":"y"]=-(b[0]||0);a[c?"height":"width"]=this.chartWidth+(b[3]||0)+(b[1]||0);a[c?"width":"height"]=this.chartHeight+(b[0]||0)+(b[2]||0);this.scale3d=1;!0===m.fitToPlot&&(this.scale3d=r(this,m.depth))}});h(v.prototype,"redraw",function(d){this.is3d()&&(this.isDirtyBox=!0,this.frame3d=this.get3dFrame());d.apply(this,[].slice.call(arguments,
1))});h(v.prototype,"render",function(d){this.is3d()&&(this.frame3d=this.get3dFrame());d.apply(this,[].slice.call(arguments,1))});h(v.prototype,"renderSeries",function(d){var m=this.series.length;if(this.is3d())for(;m--;)d=this.series[m],d.translate(),d.render();else d.call(this)});h(v.prototype,"drawChartBox",function(m){if(this.is3d()){var u=this.renderer,c=this.options.chart.options3d,a=this.get3dFrame(),b=this.plotLeft,e=this.plotLeft+this.plotWidth,g=this.plotTop,k=this.plotTop+this.plotHeight,
c=c.depth,f=b-(a.left.visible?a.left.size:0),h=e+(a.right.visible?a.right.size:0),n=g-(a.top.visible?a.top.size:0),q=k+(a.bottom.visible?a.bottom.size:0),p=0-(a.front.visible?a.front.size:0),l=c+(a.back.visible?a.back.size:0),t=this.hasRendered?"animate":"attr";this.frame3d=a;this.frameShapes||(this.frameShapes={bottom:u.polyhedron().add(),top:u.polyhedron().add(),left:u.polyhedron().add(),right:u.polyhedron().add(),back:u.polyhedron().add(),front:u.polyhedron().add()});this.frameShapes.bottom[t]({"class":"highcharts-3d-frame highcharts-3d-frame-bottom",
zIndex:a.bottom.frontFacing?-1E3:1E3,faces:[{fill:d.color(a.bottom.color).brighten(.1).get(),vertexes:[{x:f,y:q,z:p},{x:h,y:q,z:p},{x:h,y:q,z:l},{x:f,y:q,z:l}],enabled:a.bottom.visible},{fill:d.color(a.bottom.color).brighten(.1).get(),vertexes:[{x:b,y:k,z:c},{x:e,y:k,z:c},{x:e,y:k,z:0},{x:b,y:k,z:0}],enabled:a.bottom.visible},{fill:d.color(a.bottom.color).brighten(-.1).get(),vertexes:[{x:f,y:q,z:p},{x:f,y:q,z:l},{x:b,y:k,z:c},{x:b,y:k,z:0}],enabled:a.bottom.visible&&!a.left.visible},{fill:d.color(a.bottom.color).brighten(-.1).get(),
vertexes:[{x:h,y:q,z:l},{x:h,y:q,z:p},{x:e,y:k,z:0},{x:e,y:k,z:c}],enabled:a.bottom.visible&&!a.right.visible},{fill:d.color(a.bottom.color).get(),vertexes:[{x:h,y:q,z:p},{x:f,y:q,z:p},{x:b,y:k,z:0},{x:e,y:k,z:0}],enabled:a.bottom.visible&&!a.front.visible},{fill:d.color(a.bottom.color).get(),vertexes:[{x:f,y:q,z:l},{x:h,y:q,z:l},{x:e,y:k,z:c},{x:b,y:k,z:c}],enabled:a.bottom.visible&&!a.back.visible}]});this.frameShapes.top[t]({"class":"highcharts-3d-frame highcharts-3d-frame-top",zIndex:a.top.frontFacing?
-1E3:1E3,faces:[{fill:d.color(a.top.color).brighten(.1).get(),vertexes:[{x:f,y:n,z:l},{x:h,y:n,z:l},{x:h,y:n,z:p},{x:f,y:n,z:p}],enabled:a.top.visible},{fill:d.color(a.top.color).brighten(.1).get(),vertexes:[{x:b,y:g,z:0},{x:e,y:g,z:0},{x:e,y:g,z:c},{x:b,y:g,z:c}],enabled:a.top.visible},{fill:d.color(a.top.color).brighten(-.1).get(),vertexes:[{x:f,y:n,z:l},{x:f,y:n,z:p},{x:b,y:g,z:0},{x:b,y:g,z:c}],enabled:a.top.visible&&!a.left.visible},{fill:d.color(a.top.color).brighten(-.1).get(),vertexes:[{x:h,
y:n,z:p},{x:h,y:n,z:l},{x:e,y:g,z:c},{x:e,y:g,z:0}],enabled:a.top.visible&&!a.right.visible},{fill:d.color(a.top.color).get(),vertexes:[{x:f,y:n,z:p},{x:h,y:n,z:p},{x:e,y:g,z:0},{x:b,y:g,z:0}],enabled:a.top.visible&&!a.front.visible},{fill:d.color(a.top.color).get(),vertexes:[{x:h,y:n,z:l},{x:f,y:n,z:l},{x:b,y:g,z:c},{x:e,y:g,z:c}],enabled:a.top.visible&&!a.back.visible}]});this.frameShapes.left[t]({"class":"highcharts-3d-frame highcharts-3d-frame-left",zIndex:a.left.frontFacing?-1E3:1E3,faces:[{fill:d.color(a.left.color).brighten(.1).get(),
vertexes:[{x:f,y:q,z:p},{x:b,y:k,z:0},{x:b,y:k,z:c},{x:f,y:q,z:l}],enabled:a.left.visible&&!a.bottom.visible},{fill:d.color(a.left.color).brighten(.1).get(),vertexes:[{x:f,y:n,z:l},{x:b,y:g,z:c},{x:b,y:g,z:0},{x:f,y:n,z:p}],enabled:a.left.visible&&!a.top.visible},{fill:d.color(a.left.color).brighten(-.1).get(),vertexes:[{x:f,y:q,z:l},{x:f,y:n,z:l},{x:f,y:n,z:p},{x:f,y:q,z:p}],enabled:a.left.visible},{fill:d.color(a.left.color).brighten(-.1).get(),vertexes:[{x:b,y:g,z:c},{x:b,y:k,z:c},{x:b,y:k,z:0},
{x:b,y:g,z:0}],enabled:a.left.visible},{fill:d.color(a.left.color).get(),vertexes:[{x:f,y:q,z:p},{x:f,y:n,z:p},{x:b,y:g,z:0},{x:b,y:k,z:0}],enabled:a.left.visible&&!a.front.visible},{fill:d.color(a.left.color).get(),vertexes:[{x:f,y:n,z:l},{x:f,y:q,z:l},{x:b,y:k,z:c},{x:b,y:g,z:c}],enabled:a.left.visible&&!a.back.visible}]});this.frameShapes.right[t]({"class":"highcharts-3d-frame highcharts-3d-frame-right",zIndex:a.right.frontFacing?-1E3:1E3,faces:[{fill:d.color(a.right.color).brighten(.1).get(),
vertexes:[{x:h,y:q,z:l},{x:e,y:k,z:c},{x:e,y:k,z:0},{x:h,y:q,z:p}],enabled:a.right.visible&&!a.bottom.visible},{fill:d.color(a.right.color).brighten(.1).get(),vertexes:[{x:h,y:n,z:p},{x:e,y:g,z:0},{x:e,y:g,z:c},{x:h,y:n,z:l}],enabled:a.right.visible&&!a.top.visible},{fill:d.color(a.right.color).brighten(-.1).get(),vertexes:[{x:e,y:g,z:0},{x:e,y:k,z:0},{x:e,y:k,z:c},{x:e,y:g,z:c}],enabled:a.right.visible},{fill:d.color(a.right.color).brighten(-.1).get(),vertexes:[{x:h,y:q,z:p},{x:h,y:n,z:p},{x:h,y:n,
z:l},{x:h,y:q,z:l}],enabled:a.right.visible},{fill:d.color(a.right.color).get(),vertexes:[{x:h,y:n,z:p},{x:h,y:q,z:p},{x:e,y:k,z:0},{x:e,y:g,z:0}],enabled:a.right.visible&&!a.front.visible},{fill:d.color(a.right.color).get(),vertexes:[{x:h,y:q,z:l},{x:h,y:n,z:l},{x:e,y:g,z:c},{x:e,y:k,z:c}],enabled:a.right.visible&&!a.back.visible}]});this.frameShapes.back[t]({"class":"highcharts-3d-frame highcharts-3d-frame-back",zIndex:a.back.frontFacing?-1E3:1E3,faces:[{fill:d.color(a.back.color).brighten(.1).get(),
vertexes:[{x:h,y:q,z:l},{x:f,y:q,z:l},{x:b,y:k,z:c},{x:e,y:k,z:c}],enabled:a.back.visible&&!a.bottom.visible},{fill:d.color(a.back.color).brighten(.1).get(),vertexes:[{x:f,y:n,z:l},{x:h,y:n,z:l},{x:e,y:g,z:c},{x:b,y:g,z:c}],enabled:a.back.visible&&!a.top.visible},{fill:d.color(a.back.color).brighten(-.1).get(),vertexes:[{x:f,y:q,z:l},{x:f,y:n,z:l},{x:b,y:g,z:c},{x:b,y:k,z:c}],enabled:a.back.visible&&!a.left.visible},{fill:d.color(a.back.color).brighten(-.1).get(),vertexes:[{x:h,y:n,z:l},{x:h,y:q,
z:l},{x:e,y:k,z:c},{x:e,y:g,z:c}],enabled:a.back.visible&&!a.right.visible},{fill:d.color(a.back.color).get(),vertexes:[{x:b,y:g,z:c},{x:e,y:g,z:c},{x:e,y:k,z:c},{x:b,y:k,z:c}],enabled:a.back.visible},{fill:d.color(a.back.color).get(),vertexes:[{x:f,y:q,z:l},{x:h,y:q,z:l},{x:h,y:n,z:l},{x:f,y:n,z:l}],enabled:a.back.visible}]});this.frameShapes.front[t]({"class":"highcharts-3d-frame highcharts-3d-frame-front",zIndex:a.front.frontFacing?-1E3:1E3,faces:[{fill:d.color(a.front.color).brighten(.1).get(),
vertexes:[{x:f,y:q,z:p},{x:h,y:q,z:p},{x:e,y:k,z:0},{x:b,y:k,z:0}],enabled:a.front.visible&&!a.bottom.visible},{fill:d.color(a.front.color).brighten(.1).get(),vertexes:[{x:h,y:n,z:p},{x:f,y:n,z:p},{x:b,y:g,z:0},{x:e,y:g,z:0}],enabled:a.front.visible&&!a.top.visible},{fill:d.color(a.front.color).brighten(-.1).get(),vertexes:[{x:f,y:n,z:p},{x:f,y:q,z:p},{x:b,y:k,z:0},{x:b,y:g,z:0}],enabled:a.front.visible&&!a.left.visible},{fill:d.color(a.front.color).brighten(-.1).get(),vertexes:[{x:h,y:q,z:p},{x:h,
y:n,z:p},{x:e,y:g,z:0},{x:e,y:k,z:0}],enabled:a.front.visible&&!a.right.visible},{fill:d.color(a.front.color).get(),vertexes:[{x:e,y:g,z:0},{x:b,y:g,z:0},{x:b,y:k,z:0},{x:e,y:k,z:0}],enabled:a.front.visible},{fill:d.color(a.front.color).get(),vertexes:[{x:h,y:q,z:p},{x:f,y:q,z:p},{x:f,y:n,z:p},{x:h,y:n,z:p}],enabled:a.front.visible}]})}return m.apply(this,[].slice.call(arguments,1))});v.prototype.retrieveStacks=function(d){var m=this.series,c={},a,b=1;w(this.series,function(e){a=l(e.options.stack,
d?0:m.length-1-e.index);c[a]?c[a].series.push(e):(c[a]={series:[e],position:b},b++)});c.totalStacks=b+1;return c};v.prototype.get3dFrame=function(){var m=this,f=m.options.chart.options3d,c=f.frame,a=m.plotLeft,b=m.plotLeft+m.plotWidth,e=m.plotTop,g=m.plotTop+m.plotHeight,k=f.depth,h=d.shapeArea3d([{x:a,y:g,z:k},{x:b,y:g,z:k},{x:b,y:g,z:0},{x:a,y:g,z:0}],m),r=d.shapeArea3d([{x:a,y:e,z:0},{x:b,y:e,z:0},{x:b,y:e,z:k},{x:a,y:e,z:k}],m),n=d.shapeArea3d([{x:a,y:e,z:0},{x:a,y:e,z:k},{x:a,y:g,z:k},{x:a,y:g,
z:0}],m),q=d.shapeArea3d([{x:b,y:e,z:k},{x:b,y:e,z:0},{x:b,y:g,z:0},{x:b,y:g,z:k}],m),p=d.shapeArea3d([{x:a,y:g,z:0},{x:b,y:g,z:0},{x:b,y:e,z:0},{x:a,y:e,z:0}],m),v=d.shapeArea3d([{x:a,y:e,z:k},{x:b,y:e,z:k},{x:b,y:g,z:k},{x:a,y:g,z:k}],m),x=!1,z=!1,F=!1,H=!1;w([].concat(m.xAxis,m.yAxis,m.zAxis),function(a){a&&(a.horiz?a.opposite?z=!0:x=!0:a.opposite?H=!0:F=!0)});var E=function(a,b,e){for(var c=["size","color","visible"],d={},g=0;g<c.length;g++)for(var k=c[g],f=0;f<a.length;f++)if("object"===typeof a[f]){var m=
a[f][k];if(void 0!==m&&null!==m){d[k]=m;break}}a=e;!0===d.visible||!1===d.visible?a=d.visible:"auto"===d.visible&&(a=0<=b);return{size:l(d.size,1),color:l(d.color,"none"),frontFacing:0<b,visible:a}},c={bottom:E([c.bottom,c.top,c],h,x),top:E([c.top,c.bottom,c],r,z),left:E([c.left,c.right,c.side,c],n,F),right:E([c.right,c.left,c.side,c],q,H),back:E([c.back,c.front,c],v,!0),front:E([c.front,c.back,c],p,!1)};"auto"===f.axisLabelPosition?(q=function(a,b){return a.visible!==b.visible||a.visible&&b.visible&&
a.frontFacing!==b.frontFacing},f=[],q(c.left,c.front)&&f.push({y:(e+g)/2,x:a,z:0}),q(c.left,c.back)&&f.push({y:(e+g)/2,x:a,z:k}),q(c.right,c.front)&&f.push({y:(e+g)/2,x:b,z:0}),q(c.right,c.back)&&f.push({y:(e+g)/2,x:b,z:k}),h=[],q(c.bottom,c.front)&&h.push({x:(a+b)/2,y:g,z:0}),q(c.bottom,c.back)&&h.push({x:(a+b)/2,y:g,z:k}),r=[],q(c.top,c.front)&&r.push({x:(a+b)/2,y:e,z:0}),q(c.top,c.back)&&r.push({x:(a+b)/2,y:e,z:k}),n=[],q(c.bottom,c.left)&&n.push({z:(0+k)/2,y:g,x:a}),q(c.bottom,c.right)&&n.push({z:(0+
k)/2,y:g,x:b}),g=[],q(c.top,c.left)&&g.push({z:(0+k)/2,y:e,x:a}),q(c.top,c.right)&&g.push({z:(0+k)/2,y:e,x:b}),a=function(a,b,e){if(0===a.length)return null;if(1===a.length)return a[0];for(var c=0,d=t(a,m,!1),g=1;g<d.length;g++)e*d[g][b]>e*d[c][b]?c=g:e*d[g][b]===e*d[c][b]&&d[g].z<d[c].z&&(c=g);return a[c]},c.axes={y:{left:a(f,"x",-1),right:a(f,"x",1)},x:{top:a(r,"y",-1),bottom:a(h,"y",1)},z:{top:a(g,"y",-1),bottom:a(n,"y",1)}}):c.axes={y:{left:{x:a,z:0},right:{x:b,z:0}},x:{top:{y:e,z:0},bottom:{y:g,
z:0}},z:{top:{x:F?b:a,y:e},bottom:{x:F?b:a,y:g}}};return c}})(z);(function(d){function r(a,e){if(a.chart.is3d()&&"colorAxis"!==a.coll){var b=a.chart,c=b.frame3d,d=b.plotLeft,m=b.plotWidth+d,h=b.plotTop,b=b.plotHeight+h,l=0,p=0;e=a.swapZ({x:e.x,y:e.y,z:0});if(a.isZAxis)if(a.opposite){if(null===c.axes.z.top)return{};p=e.y-h;e.x=c.axes.z.top.x;e.y=c.axes.z.top.y}else{if(null===c.axes.z.bottom)return{};p=e.y-b;e.x=c.axes.z.bottom.x;e.y=c.axes.z.bottom.y}else if(a.horiz)if(a.opposite){if(null===c.axes.x.top)return{};
p=e.y-h;e.y=c.axes.x.top.y;e.z=c.axes.x.top.z}else{if(null===c.axes.x.bottom)return{};p=e.y-b;e.y=c.axes.x.bottom.y;e.z=c.axes.x.bottom.z}else if(a.opposite){if(null===c.axes.y.right)return{};l=e.x-m;e.x=c.axes.y.right.x;e.z=c.axes.y.right.z}else{if(null===c.axes.y.left)return{};l=e.x-d;e.x=c.axes.y.left.x;e.z=c.axes.y.left.z}e=f([e],a.chart)[0];e.x+=l;e.y+=p}return e}var v,w=d.Axis,x=d.Chart,t=d.each,l=d.extend,h=d.merge,f=d.perspective,m=d.pick,u=d.splat,c=d.Tick,a=d.wrap;a(w.prototype,"setOptions",
function(a,e){a.call(this,e);this.chart.is3d()&&"colorAxis"!==this.coll&&(a=this.options,a.tickWidth=m(a.tickWidth,0),a.gridLineWidth=m(a.gridLineWidth,1))});a(w.prototype,"getPlotLinePath",function(a){var b=a.apply(this,[].slice.call(arguments,1));if(!this.chart.is3d()||"colorAxis"===this.coll||null===b)return b;var c=this.chart,d=c.options.chart.options3d,d=this.isZAxis?c.plotWidth:d.depth,c=c.frame3d,b=[this.swapZ({x:b[1],y:b[2],z:0}),this.swapZ({x:b[1],y:b[2],z:d}),this.swapZ({x:b[4],y:b[5],z:0}),
this.swapZ({x:b[4],y:b[5],z:d})],d=[];this.horiz?(this.isZAxis?(c.left.visible&&d.push(b[0],b[2]),c.right.visible&&d.push(b[1],b[3])):(c.front.visible&&d.push(b[0],b[2]),c.back.visible&&d.push(b[1],b[3])),c.top.visible&&d.push(b[0],b[1]),c.bottom.visible&&d.push(b[2],b[3])):(c.front.visible&&d.push(b[0],b[2]),c.back.visible&&d.push(b[1],b[3]),c.left.visible&&d.push(b[0],b[1]),c.right.visible&&d.push(b[2],b[3]));d=f(d,this.chart,!1);return this.chart.renderer.toLineSegments(d)});a(w.prototype,"getLinePath",
function(a){return this.chart.is3d()?[]:a.apply(this,[].slice.call(arguments,1))});a(w.prototype,"getPlotBandPath",function(a){if(!this.chart.is3d()||"colorAxis"===this.coll)return a.apply(this,[].slice.call(arguments,1));var b=arguments,c=b[2],d=[],b=this.getPlotLinePath(b[1]),c=this.getPlotLinePath(c);if(b&&c)for(var f=0;f<b.length;f+=6)d.push("M",b[f+1],b[f+2],"L",b[f+4],b[f+5],"L",c[f+4],c[f+5],"L",c[f+1],c[f+2],"Z");return d});a(c.prototype,"getMarkPath",function(a){var b=a.apply(this,[].slice.call(arguments,
1)),b=[r(this.axis,{x:b[1],y:b[2],z:0}),r(this.axis,{x:b[4],y:b[5],z:0})];return this.axis.chart.renderer.toLineSegments(b)});a(c.prototype,"getLabelPosition",function(a){var b=a.apply(this,[].slice.call(arguments,1));return r(this.axis,b)});d.wrap(w.prototype,"getTitlePosition",function(a){var b=a.apply(this,[].slice.call(arguments,1));return r(this,b)});a(w.prototype,"drawCrosshair",function(a){var b=arguments;this.chart.is3d()&&b[2]&&(b[2]={plotX:b[2].plotXold||b[2].plotX,plotY:b[2].plotYold||
b[2].plotY});a.apply(this,[].slice.call(b,1))});a(w.prototype,"destroy",function(a){t(["backFrame","bottomFrame","sideFrame"],function(a){this[a]&&(this[a]=this[a].destroy())},this);a.apply(this,[].slice.call(arguments,1))});w.prototype.swapZ=function(a,c){return this.isZAxis?(c=c?0:this.chart.plotLeft,{x:c+a.z,y:a.y,z:a.x-c}):a};v=d.ZAxis=function(){this.init.apply(this,arguments)};l(v.prototype,w.prototype);l(v.prototype,{isZAxis:!0,setOptions:function(a){a=h({offset:0,lineWidth:0},a);w.prototype.setOptions.call(this,
a);this.coll="zAxis"},setAxisSize:function(){w.prototype.setAxisSize.call(this);this.width=this.len=this.chart.options.chart.options3d.depth;this.right=this.chart.chartWidth-this.width-this.left},getSeriesExtremes:function(){var a=this,c=a.chart;a.hasVisibleSeries=!1;a.dataMin=a.dataMax=a.ignoreMinPadding=a.ignoreMaxPadding=null;a.buildStacks&&a.buildStacks();t(a.series,function(b){if(b.visible||!c.options.chart.ignoreHiddenSeries)a.hasVisibleSeries=!0,b=b.zData,b.length&&(a.dataMin=Math.min(m(a.dataMin,
b[0]),Math.min.apply(null,b)),a.dataMax=Math.max(m(a.dataMax,b[0]),Math.max.apply(null,b)))})}});a(x.prototype,"getAxes",function(a){var b=this,c=this.options,c=c.zAxis=u(c.zAxis||{});a.call(this);b.is3d()&&(this.zAxis=[],t(c,function(a,c){a.index=c;a.isX=!0;(new v(b,a)).setScale()}))})})(z);(function(d){var r=d.each,v=d.perspective,w=d.pick,x=d.Series,t=d.seriesTypes,l=d.inArray,h=d.svg;d=d.wrap;d(t.column.prototype,"translate",function(d){d.apply(this,[].slice.call(arguments,1));if(this.chart.is3d()){var f=
this,h=f.chart,c=f.options,a=c.depth||25,b=f.borderWidth%2?.5:0;if(h.inverted&&!f.yAxis.reversed||!h.inverted&&f.yAxis.reversed)b*=-1;var e=(c.stacking?c.stack||0:f.index)*(a+(c.groupZPadding||1));!1!==c.grouping&&(e=0);e+=c.groupZPadding||1;r(f.data,function(c){if(null!==c.y){var d=c.shapeArgs,g=c.tooltipPos,m;r([["x","width"],["y","height"]],function(a){m=d[a[0]]-b;if(0>m+d[a[1]]||m>f[a[0]+"Axis"].len)for(var c in d)d[c]=0;0>m&&(d[a[1]]+=d[a[0]],d[a[0]]=0);m+d[a[1]]>f[a[0]+"Axis"].len&&(d[a[1]]=
f[a[0]+"Axis"].len-d[a[0]])});c.shapeType="cuboid";d.z=e;d.depth=a;d.insidePlotArea=!0;g=v([{x:g[0],y:g[1],z:e}],h,!0)[0];c.tooltipPos=[g.x,g.y]}});f.z=e}});d(t.column.prototype,"animate",function(d){if(this.chart.is3d()){var f=arguments[1],l=this.yAxis,c=this,a=this.yAxis.reversed;h&&(f?r(c.data,function(b){null!==b.y&&(b.height=b.shapeArgs.height,b.shapey=b.shapeArgs.y,b.shapeArgs.height=1,a||(b.shapeArgs.y=b.stackY?b.plotY+l.translate(b.stackY):b.plotY+(b.negative?-b.height:b.height)))}):(r(c.data,
function(a){null!==a.y&&(a.shapeArgs.height=a.height,a.shapeArgs.y=a.shapey,a.graphic&&a.graphic.animate(a.shapeArgs,c.options.animation))}),this.drawDataLabels(),c.animate=null))}else d.apply(this,[].slice.call(arguments,1))});d(t.column.prototype,"plotGroup",function(d,h,l,c,a,b){this.chart.is3d()&&b&&!this[h]&&(this[h]=b,b.attr(this.getPlotBox()),this[h].survive=!0);return d.apply(this,Array.prototype.slice.call(arguments,1))});d(t.column.prototype,"setVisible",function(d,h){var f=this,c;f.chart.is3d()&&
r(f.data,function(a){c=(a.visible=a.options.visible=h=void 0===h?!a.visible:h)?"visible":"hidden";f.options.data[l(a,f.data)]=a.options;a.graphic&&a.graphic.attr({visibility:c})});d.apply(this,Array.prototype.slice.call(arguments,1))});d(t.column.prototype,"init",function(d){d.apply(this,[].slice.call(arguments,1));if(this.chart.is3d()){var f=this.options,h=f.grouping,c=f.stacking,a=w(this.yAxis.options.reversedStacks,!0),b=0;if(void 0===h||h){h=this.chart.retrieveStacks(c);b=f.stack||0;for(c=0;c<
h[b].series.length&&h[b].series[c]!==this;c++);b=10*(h.totalStacks-h[b].position)+(a?c:-c);this.xAxis.reversed||(b=10*h.totalStacks-b)}f.zIndex=b}});d(x.prototype,"alignDataLabel",function(d){if(this.chart.is3d()&&("column"===this.type||"columnrange"===this.type)){var f=arguments[4],h={x:f.x,y:f.y,z:this.z},h=v([h],this.chart,!0)[0];f.x=h.x;f.y=h.y}d.apply(this,[].slice.call(arguments,1))})})(z);(function(d){var r=d.deg2rad,v=d.each,w=d.seriesTypes,x=d.svg;d=d.wrap;d(w.pie.prototype,"translate",function(d){d.apply(this,
[].slice.call(arguments,1));if(this.chart.is3d()){var l=this,h=l.options,f=h.depth||0,m=l.chart.options.chart.options3d,u=m.alpha,c=m.beta,a=h.stacking?(h.stack||0)*f:l._i*f,a=a+f/2;!1!==h.grouping&&(a=0);v(l.data,function(b){var d=b.shapeArgs;b.shapeType="arc3d";d.z=a;d.depth=.75*f;d.alpha=u;d.beta=c;d.center=l.center;d=(d.end+d.start)/2;b.slicedTranslation={translateX:Math.round(Math.cos(d)*h.slicedOffset*Math.cos(u*r)),translateY:Math.round(Math.sin(d)*h.slicedOffset*Math.cos(u*r))}})}});d(w.pie.prototype.pointClass.prototype,
"haloPath",function(d){var l=arguments;return this.series.chart.is3d()?[]:d.call(this,l[1])});d(w.pie.prototype,"drawPoints",function(d){d.apply(this,[].slice.call(arguments,1));this.chart.is3d()&&v(this.points,function(d){var h=d.graphic;if(h)h[d.y&&d.visible?"show":"hide"]()})});d(w.pie.prototype,"drawDataLabels",function(d){if(this.chart.is3d()){var l=this.chart.options.chart.options3d;v(this.data,function(d){var f=d.shapeArgs,h=f.r,u=(f.start+f.end)/2,c=d.labelPos,a=-h*(1-Math.cos((f.alpha||l.alpha)*
r))*Math.sin(u),b=h*(Math.cos((f.beta||l.beta)*r)-1)*Math.cos(u);v([0,2,4],function(d){c[d]+=b;c[d+1]+=a})})}d.apply(this,[].slice.call(arguments,1))});d(w.pie.prototype,"addPoint",function(d){d.apply(this,[].slice.call(arguments,1));this.chart.is3d()&&this.update(this.userOptions,!0)});d(w.pie.prototype,"animate",function(d){if(this.chart.is3d()){var l=arguments[1],h=this.options.animation,f=this.center,m=this.group,u=this.markerGroup;x&&(!0===h&&(h={}),l?(m.oldtranslateX=m.translateX,m.oldtranslateY=
m.translateY,l={translateX:f[0],translateY:f[1],scaleX:.001,scaleY:.001},m.attr(l),u&&(u.attrSetters=m.attrSetters,u.attr(l))):(l={translateX:m.oldtranslateX,translateY:m.oldtranslateY,scaleX:1,scaleY:1},m.animate(l,h),u&&u.animate(l,h),this.animate=null))}else d.apply(this,[].slice.call(arguments,1))})})(z);(function(d){var r=d.perspective,v=d.pick,w=d.Point,x=d.seriesTypes,t=d.wrap;t(x.scatter.prototype,"translate",function(d){d.apply(this,[].slice.call(arguments,1));if(this.chart.is3d()){var h=
this.chart,f=v(this.zAxis,h.options.zAxis[0]),m=[],l,c,a;for(a=0;a<this.data.length;a++)l=this.data[a],c=f.isLog&&f.val2lin?f.val2lin(l.z):l.z,l.plotZ=f.translate(c),l.isInside=l.isInside?c>=f.min&&c<=f.max:!1,m.push({x:l.plotX,y:l.plotY,z:l.plotZ});h=r(m,h,!0);for(a=0;a<this.data.length;a++)l=this.data[a],f=h[a],l.plotXold=l.plotX,l.plotYold=l.plotY,l.plotZold=l.plotZ,l.plotX=f.x,l.plotY=f.y,l.plotZ=f.z}});t(x.scatter.prototype,"init",function(d,h,f){h.is3d()&&(this.axisTypes=["xAxis","yAxis","zAxis"],
this.pointArrayMap=["x","y","z"],this.parallelArrays=["x","y","z"],this.directTouch=!0);d=d.apply(this,[h,f]);this.chart.is3d()&&(this.tooltipOptions.pointFormat=this.userOptions.tooltip?this.userOptions.tooltip.pointFormat||"x: \x3cb\x3e{point.x}\x3c/b\x3e\x3cbr/\x3ey: \x3cb\x3e{point.y}\x3c/b\x3e\x3cbr/\x3ez: \x3cb\x3e{point.z}\x3c/b\x3e\x3cbr/\x3e":"x: \x3cb\x3e{point.x}\x3c/b\x3e\x3cbr/\x3ey: \x3cb\x3e{point.y}\x3c/b\x3e\x3cbr/\x3ez: \x3cb\x3e{point.z}\x3c/b\x3e\x3cbr/\x3e");return d});t(x.scatter.prototype,
"pointAttribs",function(l,h){var f=l.apply(this,[].slice.call(arguments,1));this.chart.is3d()&&h&&(f.zIndex=d.pointCameraDistance(h,this.chart));return f});t(w.prototype,"applyOptions",function(d){var h=d.apply(this,[].slice.call(arguments,1));this.series.chart.is3d()&&void 0===h.z&&(h.z=0);return h})})(z)});

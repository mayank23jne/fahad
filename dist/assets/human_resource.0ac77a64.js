import{D as u}from"./KTDataTable.c04eda30.js";import"./RolesAddNewModal.vue_vue_type_script_lang.b2e590cd.js";import{d as _,r as a,o as h,G as f,_ as v,k as o,l as s,F as b,J as g,B as x,n as r,m as C,p as D}from"./index.40c6202a.js";import{K as k}from"./WidgetDonut.adae6006.js";import"./dom.d7d6c49b.js";import"./sweetalert2.all.fbc178e9.js";import"./Dropdown1.fad167fe.js";const B=_({name:"human_resource",components:{Datatable:u,KTChartWidgetDonut:k},setup(){const e=a([]);a([]);const d=a(!1);a([]);const c=a([]);return h(()=>{f.get("totalHrTemplates").then(({data:n})=>{c.value=n,n.forEach((t,l)=>{e.value.push({labels:t.data,datasets:[{borderWidth:2,data:t.Values,name:t.Name,template_id:t.template_id}]})}),d.value=!0})}),{listdata:e,loaded:d}}}),K={class:"card"},N=s("div",{class:"card-header border-0 pt-6"},[s("div",{class:"card-title"}),s("div",{class:"card-toolbar"})],-1),T={class:"card-body pt-0"},V={key:0,class:"col-xl-12"},W={class:"row"};function $(e,d,c,n,t,l){const i=D("KTChartWidgetDonut");return r(),o("div",K,[N,s("div",T,[e.loaded?(r(),o("div",V,[s("div",W,[(r(!0),o(b,null,g(e.listdata,(m,p)=>(r(),o("div",{class:"col-xl-6",key:p},[C(i,{"widget-classes":"card-xl-stretch mb-xl-8",data:m},null,8,["data"])]))),128))])])):x("",!0)])])}const J=v(B,[["render",$]]);export{J as default};

import{d as h,u as v,r as n,o as y,G as k,_ as g,k as a,l as t,I as p,B as w,F as b,J as m,n as r}from"./index.40c6202a.js";const A=h({name:"performance_em",components:{},setup(){const{t:e,te:u}=v(),l=n([]),d=n([]),_=n(""),c=n([]);n([]);const s=o=>u(o)?e(o):o;return y(()=>(_.value="\u062A\u0642\u0631\u064A\u0631 \u0627\u062F\u0627\u0621 \u0645\u0648\u0638\u0641\u064A  \u0627\u0644\u0637\u0648\u0627\u0631\u0626 :",k.get("userReportsAnswer/\u0627\u0645\u0627\u0643\u0646").then(({data:o})=>{l.value=o.header,c.value=o.answers}).catch(({response:o})=>{}))),{tableData:c,tableHeader:l,exportexcel:()=>{window.open("https://forms.innovativeideasbox.com/API/api/exportUserReportsAnswer/\u0627\u0645\u0627\u0643\u0646","_blank")},selectedIds:d,translate:s,onItemSelect:o=>{d.value=o}}}}),I={class:"card"},x={class:"card-header border-0 pt-6"},$=t("div",{class:"card-title"},null,-1),B={class:"card-toolbar"},D={key:0,class:"d-flex justify-content-end","data-kt-customer-table-toolbar":"base"},S={class:"card-body pt-0"},C={class:"table-responsive"},F=["items"],H={class:"fw-bolder fs-5 text-gray-800"};function N(e,u,l,d,_,c){return r(),a("div",I,[t("div",x,[$,t("div",B,[e.selectedIds.length===0?(r(),a("div",D,[t("button",{type:"button",class:"btn btn-primary",onClick:u[0]||(u[0]=(...s)=>e.exportexcel&&e.exportexcel(...s))},p(e.$t("export")),1)])):w("",!0)])]),t("div",S,[t("div",C,[t("table",{class:"table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer",items:e.tableData},[t("thead",null,[t("tr",H,[(r(!0),a(b,null,m(e.tableHeader,s=>(r(),a("th",{key:s},p(s),1))),128))])]),t("tbody",null,[(r(!0),a(b,null,m(e.tableData,s=>(r(),a("tr",{key:s},[(r(!0),a(b,null,m(e.tableHeader,(f,i)=>(r(),a("td",{key:i},p(s[i]),1))),128))]))),128))])],8,F)])])])}const V=g(A,[["render",N]]);export{V as default};

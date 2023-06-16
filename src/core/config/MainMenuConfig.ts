export interface MenuItem {
  heading?: string;
  sectionTitle?: string;
  route?: string;
  params?:string;
  pages?: Array<MenuItem>;
  svgIcon?: string;
  fontIcon?: string;
  sub?: Array<MenuItem>;
  role?:any;
}

import { Role } from "@/utils/role";

let isAdmin = "";
if(Role.Admin == localStorage.getItem('user_role')){
  isAdmin = 'admin';
}
const MainMenuConfig: Array<MenuItem> = [
  {
    pages: [
      {
        heading: "dashboard",
        route: "/dashboard",
        svgIcon: "/media/icons/duotune/art/art002.svg",
        fontIcon: "bi-app-indicator",
        role:'admin',
      },
      {
        // heading: "dashboard",
        // route: "/dashboard",
        // svgIcon: "/media/icons/duotune/art/art002.svg",
        // fontIcon: "bi-app-indicator",
        
            sectionTitle: "dashboard",
            route: "/dashboard",
            svgIcon: "/media/icons/duotune/art/art002.svg",
            fontIcon: "bi-app-indicator",
            role:'user',
            sub: [
              {
                // General ratios of emergencies
                heading: "Generalpercentagesem",
                route: "/dashboard/Em_default",
                role:'user',
              },
              {
                // General ratios of human resources
                heading: "Generalpercentageshr",
                route: "/dashboard/default",
                role: 'user',
              },
             
                  ]
          },
          {
            sectionTitle: "masters",
            route: "/masters",
            svgIcon: "/media/icons/duotune/abstract/abs029.svg",
            fontIcon: "bi-printer",
            role:'admin',
            sub: [
              {
                // industry type
                heading: "industrytype",
                route: "/masters/industrytype",
                role:'admin',
              },
              {
                //inspection type
                heading: "inspectiontype",
                route: "/masters/inspectiontype",
                role:'admin',
              },
              {
                //  inspection property type
                heading: "inspectionpropertytype",
                route: "/masters/inspectionpropertytype",
                role:'admin',
              },
              // {
              //   // registered property
              //   heading: "propertytype",  
              //   route: "/masters/propertytype",
              //   role:'user',
              // },
              {
                // registered property
                heading: "registeredproperty",  
                route: "/masters/registeredproperty",
                role:'admin',
              },
             
            ],
          },
      
    ],
  },
  // {
  //   heading: "craft",
  //   route: "/crafted",
  //   pages: [
  //     {
  //       sectionTitle: "pages",
  //       route: "/pages",
  //       svgIcon: "/media/icons/duotune/general/gen022.svg",
  //       fontIcon: "bi-archive",
  //       sub: [
  //         {
  //           sectionTitle: "profile",
  //           route: "/profile",
  //           sub: [
  //             {
  //               heading: "profileOverview",
  //               route: "/crafted/pages/profile/overview",
  //             },
  //             {
  //               heading: "projects",
  //               route: "/crafted/pages/profile/projects",
  //             },
  //             {
  //               heading: "campaigns",
  //               route: "/crafted/pages/profile/campaigns",
  //             },
  //             {
  //               heading: "documents",
  //               route: "/crafted/pages/profile/documents",
  //             },
  //             {
  //               heading: "connections",
  //               route: "/crafted/pages/profile/connections",
  //             },
  //             {
  //               heading: "activity",
  //               route: "/crafted/pages/profile/activity",
  //             },
  //           ],
  //         },
  //         {
  //           sectionTitle: "wizards",
  //           route: "/wizard",
  //           sub: [
  //             {
  //               heading: "horizontal",
  //               route: "/crafted/pages/wizards/horizontal",
  //             },
  //             {
  //               heading: "vertical",
  //               route: "/crafted/pages/wizards/vertical",
  //             },
  //           ],
  //         },
  //       ],
  //     },
  //     {
  //       sectionTitle: "account",
  //       route: "/account",
  //       svgIcon: "/media/icons/duotune/communication/com006.svg",
  //       fontIcon: "bi-person",
  //       sub: [
  //         {
  //           heading: "accountOverview",
  //           route: "/crafted/account/overview",
  //         },
  //         {
  //           heading: "settings",
  //           route: "/crafted/account/settings",
  //         },
  //       ],
  //     },
  //     {
  //       sectionTitle: "authentication",
  //       svgIcon: "/media/icons/duotune/technology/teh004.svg",
  //       fontIcon: "bi-sticky",
  //       sub: [
  //         {
  //           sectionTitle: "basicFlow",
  //           sub: [
  //             {
  //               heading: "signIn",
  //               route: "/sign-in",
  //             },
  //             {
  //               heading: "signUp",
  //               route: "/sign-up",
  //             },
  //             {
  //               heading: "passwordReset",
  //               route: "/password-reset",
  //             },
  //           ],
  //         },
  //         {
  //           heading: "multiStepSignUp",
  //           route: "/multi-step-sign-up",
  //         },
  //         {
  //           heading: "error404",
  //           route: "/404",
  //         },
  //         {
  //           heading: "error500",
  //           route: "/500",
  //         },
  //       ],
  //     },
  //     {
  //       sectionTitle: "modals",
  //       route: "/modals",
  //       svgIcon: "/media/icons/duotune/art/art009.svg",
  //       fontIcon: "bi-shield-check",
  //       sub: [
  //         {
  //           sectionTitle: "general",
  //           route: "/general",
  //           sub: [
  //             {
  //               heading: "inviteFriends",
  //               route: "/crafted/modals/general/invite-friends",
  //             },
  //             {
  //               heading: "viewUsers",
  //               route: "/crafted/modals/general/view-user",
  //             },
  //             {
  //               heading: "upgradePlan",
  //               route: "/crafted/modals/general/upgrade-plan",
  //             },
  //             {
  //               heading: "shareAndEarn",
  //               route: "/crafted/modals/general/share-and-earn",
  //             },
  //           ],
  //         },
  //         {
  //           sectionTitle: "forms",
  //           route: "/forms",
  //           sub: [
  //             {
  //               heading: "newTarget",
  //               route: "/crafted/modals/forms/new-target",
  //             },
  //             {
  //               heading: "newCard",
  //               route: "/crafted/modals/forms/new-card",
  //             },
  //             {
  //               heading: "newAddress",
  //               route: "/crafted/modals/forms/new-address",
  //             },
  //             {
  //               heading: "createAPIKey",
  //               route: "/crafted/modals/forms/create-api-key",
  //             },
  //           ],
  //         },
  //         {
  //           sectionTitle: "wizards",
  //           route: "/wizards",
  //           sub: [
  //             {
  //               heading: "twoFactorAuth",
  //               route: "/crafted/modals/wizards/two-factor-auth",
  //             },
  //             {
  //               heading: "createApp",
  //               route: "/crafted/modals/wizards/create-app",
  //             },
  //             {
  //               heading: "createAccount",
  //               route: "/crafted/modals/wizards/create-account",
  //             },
  //           ],
  //         },
  //       ],
  //     },
  //     {
  //       sectionTitle: "widgets",
  //       route: "/widgets",
  //       svgIcon: "/media/icons/duotune/general/gen025.svg",
  //       fontIcon: "bi-layers",
  //       sub: [
  //         {
  //           heading: "widgetsLists",
  //           route: "/crafted/widgets/lists",
  //         },
  //         {
  //           heading: "widgetsStatistics",
  //           route: "/crafted/widgets/statistics",
  //         },
  //         {
  //           heading: "widgetsCharts",
  //           route: "/crafted/widgets/charts",
  //         },
  //         {
  //           heading: "widgetsMixed",
  //           route: "/crafted/widgets/mixed",
  //         },
  //         {
  //           heading: "widgetsTables",
  //           route: "/crafted/widgets/tables",
  //         },
  //         {
  //           heading: "widgetsFeeds",
  //           route: "/crafted/widgets/feeds",
  //         },
  //       ],
  //     },
  //   ],
  // },
  {
    heading: "apps",
    route: "/apps",
    role:'user',
    pages: [
      {
        sectionTitle: "Reports",
        route: "/reports",
        svgIcon: "/media/icons/duotune/finance/fin006.svg",
        fontIcon: "bi-printer",
        role:'user',
        sub: [
          {
            // Emergency staff performance report
            heading: "performanceem",
            route: "/app/reports/performance/em",
            role: 'user',
          },
          {
            // HR staff performance report
            heading: "performancehr",
            route: "/app/reports/performance/hr",
            role: 'user',
          },
          {
            // HR report
            heading: "humanresource",
            route: "/app/reports/human_resource",
            role: 'user',
          },
          {
            // emergency report
            heading: "emergency_report",
            route: "/app/reports/emergency_report",
            role: 'user',
          },
          {
            // Denied emergency missions
            heading: "notcompletedtaskem",
            route: "/apps/reports/notcompletedtask/em",
            role: 'user',
          },
          {
            // /Rejected HR tasks
            heading: "notcompletedtaskhr",
            route: "/apps/reports/notcompletedtask/hr",
            role: 'user',
          },
          {
            // Outstanding emergency missions
            heading: "pendingtaskem",
            route: "/apps/reports/pendingtask/em",
            role: 'user',
          },
          {
            //  Outstanding HR tasks
            heading: "pendingtaskhr",
            route: "/apps/reports/pendingtask/hr",
            role: 'user',
          },
          {
            // Completed emergency tasks
            heading:"completedtaskem",
            route: "/apps/reports/completedtask/em",
            role: 'user',
          },
          {
            // Completed HR tasks
            heading: "completedtaskhr",
            route: "/apps/reports/completedtask/hr",
            role: 'user',
            },
              {
            // Template reports
            heading: "surveylistforreport",
            route: "/apps/reports/surveylistforreport",
            role: 'user',
            },
            {
            // Emergency completion rate report
            heading: "units_status_em",
            route: "/app/reports/units_status_em",
            role: 'user',
            },
            {
            // Report of achievement percentages for human resources
            heading: "units_status_hr",
            route: "/app/reports/units_status_hr",
            role: 'user',
            },
        ],
      },
      {
        sectionTitle: "Applications",
        route: "/applications",
        svgIcon: "/media/icons/duotune/abstract/abs026.svg",
        fontIcon: "bi-printer",
        role:'user',
        sub: [
          {
            // To do list
            heading: "todolist",
            route: "/apps/applications/todo",
            role: 'user',
          },
          {
            // Create an assessment
            heading: "surveylist",
            route: "/apps/applications/surveylist",
            role: 'user',
          },
          {
            //  Create forms
            heading: "survey",
            route: "/apps/applications/survey",
            role: 'user',
          },
         
        ],
      },
      {
        sectionTitle: "masters",
        route: "/masters",
        svgIcon: "/media/icons/duotune/abstract/abs029.svg",
        fontIcon: "bi-printer",
        role:'user',
        sub: [
          {
            // industry type
            heading: "industrytype",
            route: "/masters/industrytype",
            role:'user',
          },
          {
            //inspection type
            heading: "inspectiontype",
            route: "/masters/inspectiontype",
            role:'user',
          },
          {
            //  inspection property type
            heading: "inspectionpropertytype",
            route: "/masters/inspectionpropertytype",
            role:'user',
          },
          // {
          //   // registered property
          //   heading: "propertytype",  
          //   route: "/masters/propertytype",
          //   role:'user',
          // },
          {
            // registered property
            heading: "registeredproperty",  
            route: "/masters/registeredproperty",
            role:'user',
          },
          {
            // Add a contractor
            heading: "addcontractor",
            route: "/masters/contractor",
            role: 'user',
          },
          {
            // Module List
            heading: "listofunits",
            route: "/masters/unitsupdate",
            role: 'user',
          },
          {
            // Add unit types
            heading: "addunitypes",
            route: "/masters/unitestypes",
            role: 'user',
          },
          {
            // /Register a new unit
            heading: "newunit",
            route: "/masters/units",
            role: 'user',
          },
          {
            // User list
            heading: "listofusers",
            route: "/masters/usersupdate",
            role: 'user',
          },
          {
            //  Add user scores
            heading: "adduscores",
            route: "/masters/roles",
            role: 'user'
          },
          {
            // The nature of the business
            heading: "category",
            route: "/masters/category",
            role: 'user',
          },
          {
            // Add a new user
            heading: "addnewuser",
            route: "/masters/register",
            role: 'user',
            }
         
        ],
      },
      
     
      // {
      //   sectionTitle: "customers",
      //   route: "/customers",
      //   svgIcon: "/media/icons/duotune/finance/fin006.svg",
      //   fontIcon: "bi-printer",
      //   sub: [
      //     {
      //       heading: "gettingStarted",
      //       route: "/apps/customers/getting-started",
      //     },
      //     {
      //       heading: "customersListing",
      //       route: "/apps/customers/customers-listing",
      //     },
      //     {
      //       heading: "customerDetails",
      //       route: "/apps/customers/customer-details",
      //     },
      //   ],
      // },
      // {
      //   sectionTitle: "subscriptions",
      //   route: "/subscriptions",
      //   svgIcon: "/media/icons/duotune/ecommerce/ecm002.svg",
      //   fontIcon: "bi-cart",
      //   sub: [
      //     {
      //       heading: "getStarted",
      //       route: "/apps/subscriptions/getting-started",
      //     },
      //     {
      //       heading: "subscriptionList",
      //       route: "/apps/subscriptions/subscription-list",
      //     },
      //     {
      //       heading: "addSubscription",
      //       route: "/apps/subscriptions/add-subscription",
      //     },
      //     {
      //       heading: "viewSubscription",
      //       route: "/apps/subscriptions/view-subscription",
      //     },
      //   ],
      // },
      // {
      //   heading: "calendarApp",
      //   route: "/apps/calendar",
      //   svgIcon: "/media/icons/duotune/general/gen014.svg",
      //   fontIcon: "bi-calendar3-event",
      // },
      // {
      //   sectionTitle: "chat",
      //   route: "/chat",
      //   svgIcon: "/media/icons/duotune/communication/com012.svg",
      //   fontIcon: "bi-chat-left",
      //   sub: [
      //     {
      //       heading: "privateChat",
      //       route: "/apps/chat/private-chat",
      //     },
      //     {
      //       heading: "groupChat",
      //       route: "/apps/chat/group-chat",
      //     },
      //     {
      //       heading: "drawerChat",
      //       route: "/apps/chat/drawer-chat",
      //     },
      //   ],
      // },
    ],
  },
];

export default MainMenuConfig;

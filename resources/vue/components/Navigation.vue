<template>
    <div>
        <div id="nav-overlay" class="d-print-none"></div>

        <div id="top-nav" class="d-print-none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="nav-container">
                            <img src="../../icons/custom/menu-white-jagged.svg" class="nav-icon js-open-mobile-menu">
                            <h2 class="page-nav-title">Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="side-nav" class="d-print-none no-scrollbar">

            <div class="sidebar-logo p-0">
                <a href="index.php"><img src="../../img/logo-erp.jpg"></a>
            </div>

            <div class="fixed-drawer mt-10">
                <div class="sidebar-link add-spinner">
                    <router-link :to="{ name: 'EmployeeIndex'}">
                        <img src="../../icons/user-dark.svg" class="icon">
                        <img src="../../icons/chevron-right-dark.svg" class="cue">
                        Employee Database
                    </router-link>
                </div>
            </div>
        </section>
    </div>
</template>

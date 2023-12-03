<template>
    <section id="content">

        <div class="sgx-title">
            <h1>
                <router-link :to="{ name: 'EmployeeIndex'}" class="item">
                    <img src="../../../icons/arrow-left-blue.svg" class="separate back">
                </router-link>
                {{ this.employee.name }}
            </h1>
        </div>

        <form @submit.prevent="employeeUpdate">
            <div class="sgx-table">
                <div class="form-about">
                    Employee Information
                </div>
                <div class="table-wrapper">
                    <table class="table">
                    <thead>
                        <tr>
                            <th colspan="99">Work Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="sgx-w-200 cell-title">Company</td>
                            <td class="sgx-w-300 input-td">
                                <select v-model="selectedCompany" :class="{'error': validation.company_id }">
                                    <option value="" >--Options--</option>
                                    <option
                                        v-for="(name, id) in comapanyList"
                                        :key="id"
                                        :value="id">
                                        {{ name }}
                                    </option>
                                </select>
                            </td>
                            <td><em class="o5" v-if="validation.company_id">{{ validation.company_id.join(", ") }}</em></td>
                        </tr>
                        <tr>
                            <td class="sgx-w-200 cell-title">Department</td>
                            <td class="sgx-w-300 input-td">
                                <select v-model="selectedDepartment" :class="{'error': validation.department_id }">
                                    <option value="">--Options--</option>
                                    <option v-for="(name, id) in departmentList"
                                        :key="id"
                                        :value="id"
                                        >
                                        {{ name }}
                                    </option>
                                </select>
                            </td>
                            <td><em class="o5" v-if="validation.department_id">{{ validation.department_id.join(", ") }}</em></td>
                        </tr>
                        <tr>
                            <td class="sgx-w-200 cell-title">Name</td>
                            <td class="sgx-w-300 input-td">
                                <input type="text"
                                    v-model="employee.name"
                                    :class="{'error': validation.name }"
                                    >
                            </td>
                            <td><em class="o5" v-if="validation.name">{{ validation.name.join(", ") }}</em></td>
                        </tr>
                        <tr>
                            <td class="sgx-w-200 cell-title">NIK</td>
                            <td class="sgx-w-300 input-td">
                                <input type="text"
                                    v-model="employee.nik"
                                    :class="{'error': validation.nik }"
                                    >
                            </td>
                            <td><em class="o5" v-if="validation.nik">{{ validation.nik.join(", ") }}</em></td>
                        </tr>
                        <tr>
                            <td class="sgx-w-200 cell-title">Status</td>
                            <td class="sgx-w-300 input-td">
                                <select v-model="selectedStatus" :class="{'error': validation.status }">
                                    <option value="">--Options--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </td>
                            <td><em class="o5" v-if="validation.status">{{ validation.status.join(", ") }}</em></td>
                        </tr>
                        <tr>
                            <td class="sgx-w-200 cell-title">Join Date</td>
                            <td class="sgx-w-300 input-td"><input type="date" v-model="employee.join_date_form" :class="{'error': validation.join_date }"></td>
                            <td><em class="o5" v-if="validation.join_date">{{ validation.join_date.join(", ") }}</em></td>
                        </tr>
                        <tr>
                            <td class="sgx-w-200 cell-title">Date of Birth</td>
                            <td class="sgx-w-300 input-td"><input type="date" v-model="employee.dob" :class="{'error': validation.dob }"></td>
                            <td><em class="o5" v-if="validation.dob">{{ validation.dob.join(", ") }}</em></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="sgx-form">
                <div class="form-section brd-bottom brd-top">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-sea hms-btn add-spinner white-spinner pop">Save</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal anchor-modal splash" id="general-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-header">
                    <img src="../../../img/modal-head.jpg">
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert">Data has been successfully recorded</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn hms-btn btn-light pop" data-dismiss="modal" @click="closeModalSuccess">Okay</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
    import { ref } from 'vue'
    import { Modal } from 'bootstrap'
    import conf from '../../../js/constants'

    export default {
        data() {
            return {
                comapanyList: {},
                departmentList: {},
                selectedCompany: ref(''),
                selectedDepartment: ref(''),
                selectedStatus: ref(''),
                employee: {},
                validation: [],
                modalSuccess: {},
                employeeId: this.$route.params.id,
            }
        },
        mounted() {
            this.modalSuccess = new Modal('#general-dialog', {
                backdrop: 'static',
                keyboard: false
            })
        },
        created() {
            this.axios
                .get(conf.API.GET_COMPANY_LIST)
                .then(response => {
                    this.comapanyList = response.data.data;
                });

            this.axios
                .get(conf.API.GET_DEPARTMENT_LIST)
                .then(response => {
                    this.departmentList = response.data.data;
                });

            this.axios
                .get(conf.API.EMPLOYEE + '/' + this.employeeId)
                .then(response => {
                    this.employee = response.data.data;
                    this.selectedCompany = this.employee.company_id;
                    this.selectedDepartment = this.employee.department_id;
                    this.selectedStatus = this.employee.status;
                })
                .catch(function(error){
                    console.log(error)
                });
        },
        methods: {
            async employeeUpdate() {
                this.employee.company_id = this.selectedCompany;
                this.employee.department_id = this.selectedDepartment;
                this.employee.status = this.selectedStatus;

                this.axios.patch(conf.API.EMPLOYEE, this.employee)
                    .then((response) => {
                        this.openModalSuccess()
                        this.resetForm()
                    }).catch(error => {
                        this.validation = error.response.data.errors;
                    });
            },
            openModalSuccess() {
                this.modalSuccess.show()
            },
            closeModalSuccess() {
                this.modalSuccess.hide()
                this.$router.push({
                    name: 'EmployeeIndex'
                });
            }
        }
    }
</script>

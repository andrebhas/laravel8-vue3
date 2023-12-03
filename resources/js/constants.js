
const BASE_URL = 'http://127.0.0.1:8989'
const API_VERSION = '/api/v1';

const API = {
    'GET_COMPANY_LIST': `${BASE_URL}${API_VERSION}/company-list`,
    'GET_DEPARTMENT_LIST': `${BASE_URL}${API_VERSION}/department-list`,
    'EMPLOYEE': `${BASE_URL}${API_VERSION}/employees`,
    'EMPLOYEE_SUMMARY': `${BASE_URL}${API_VERSION}/employees/summary`,
}

module.exports = {
    API
}




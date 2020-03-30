<template>
    <div>
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">
                <div class="profile-image">
                    <img
                        :src="employee.avatar || '/img/user.svg'"
                        class="img-circle circle-border m-b-md"
                        alt="Profile Picture"
                    />
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h1 class="no-margins">
                                {{
                                    `${employee.First_name ||
                                        ""} ${employee.Last_Name ||
                                        ""} ${employee.Middle_Name || ""}`
                                }}
                            </h1>
                            <h4>Initials: {{ employee.Initials }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Title</strong>
                            </td>
                            <td>
                                {{ employee.Title }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Department</strong>
                            </td>
                            <td>
                                {{ employee.Department }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Date of Join</strong>
                            </td>
                            <td>
                                {{ employee.Employment_Date }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Date of Birth</strong>
                            </td>
                            <td>
                                {{ employee.Birth_Date }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Name of Manager</strong>
                            </td>
                            <td>
                                {{ employee.Company_E_Mail }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ">
                <div class="row m-b-lg">
                    <div class="col-lg-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab-1"
                                        >Personal info</a
                                    >
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#tab-2"
                                        >Contacts info</a
                                    >
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#tab-3"
                                        >Bank Details</a
                                    >
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID Number</th>
                                                    <th>
                                                        {{
                                                            employee.National_ID
                                                        }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>NSSF</td>
                                                    <td>
                                                        {{ employee.NSSF_No }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>NHIF</td>
                                                    <td>
                                                        {{ employee.NHIF_No }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Passport</td>
                                                    <td>
                                                        {{
                                                            employee.Passport_No
                                                        }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Helb</td>
                                                    <td>
                                                        {{ employee.HELB_NO }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Pin Number</td>
                                                    <td>
                                                        {{
                                                            employee.Passport_No
                                                        }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Phone 1</td>
                                                    <td>
                                                        {{ employee.Phone_No }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Phone 2</td>
                                                    <td>
                                                        {{
                                                            employee.Mobile_Phone_No
                                                        }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>
                                                        {{ employee.E_Mail }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>
                                                        {{ employee.Address }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Bank Name</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Branch</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Account No.</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile",
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.$store.dispatch("profile/getEmployee", v.$auth.user().id);
        });
    },
    computed: {
        employee() {
            return this.$store.getters["profile/employee"];
        }
    }
};
</script>

<style scoped></style>

<template>
  <div class="container-fluid">
    <div class="col-12">
      <div class="mt-4">
        <loading v-show="loading" />

        <h5
            v-show="!loading && situation.length === 0"
            class="ml-4"
        >
          Cargando datos...
        </h5>
      </div>
    </div>
    <div class="row p-3">
      <div class="col-sm-12 col-md-6  mx-auto">
        <h2 class="text-primary"> Queremos conocer cuáles son tus necesidades, inquietudes y desafíos.</h2>
        <h4> Contestá cada espacio con el mayor detalle posible.</h4>
        <form @submit.prevent="onSubmit">
          <div class="form-row">
            <form-input
                v-model="form.firstName"
                class="col"
                v-bind="getFieldProps('firstName', 'Nombre:')"
                @blur="validateField"
            />
            <form-input
                v-model="form.lastName"
                class="col"
                v-bind="getFieldProps('lastName', 'Apellido:')"
                @blur="validateField"
            />
            <form-date
                v-model="form.dateOfBirthAt"
                class="col"
                v-bind="getFieldProps('dateOfBirthAt', 'Fecha de nacimiento:')"
            />
            <div class="form-group">
              <label
                  class="col-form-label"
              >
                Sexo
              </label><br/>
              <input type="radio" id="masculino" value="Masculino" v-model="form.sex">
              <label class="me-3" for="masculino">Masculino</label>
              <input type="radio" id="femenino" value="Femenino" v-model="form.sex">
              <label class="me-3" for="femenino">Femenino</label>
              <input type="radio" id="no_contesta" value="No Contesto" v-model="form.sex">
              <label for="no_contesta">No Contesto</label>
            </div>
            <form-input
                v-model="form.email"
                class="col"
                v-bind="getFieldProps('email', 'Email:')"
                @blur="validateField"
            />

            <div class="form-row justify-content-end align-items-center">
<!--              <loading v-show="loading" />-->

              <div class="col-auto">
                <button
                    type="submit"
                    class="btn btn-info btn-lg"

                >
                  Siguiente
                </button>
              </div>
            </div>
<!--            <div class="form-group">-->
<!--              <label-->
<!--                  class="col-form-label"-->
<!--              >-->
<!--                Situación Relacional-->
<!--              </label><br/>-->
<!--            <span-->
<!--                v-for="relational in situation"-->
<!--                :key="relational['id']"-->

<!--            >-->
<!--              <input type="radio" :id="relational['id']" :value="relational.name" v-model="form.relationalSituation">-->
<!--              <label class="me-3" :for="relational['id']">{{relational.name}}</label>-->
<!--            </span>-->
<!--            </div>-->

          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import FormInput from "/assets/components/Inputs/form-input";
import FormDate from "/assets/components/Inputs/form-date";
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';
// import RelationalSituation from '/assets/components/relational-situation';
// import { fetchRelationalSituation } from '/assets/store/services/relational_situation';
import Loading from '/assets/components/loading';
import { saveMember } from '/assets/store/services/member-service';

export default {
  name: "Member",
  components: {
    FormInput,
    DatePick,
    FormDate,
    // fetchRelationalSituation,
    // RelationalSituation
    Loading,
  },
  props: {
    member: {
      type: Object,
    },
  },
  data() {
    return {
      situation: {},
      form: {
        firstName: '',
        lastName: '',
        dateOfBirthAt: '',
        sex: '',
        // relationalSituation:'',
        email:''

      },
      validationErrors: this.getEmptyValidationErrors(),
      loading: false,
      serverError: false,
    };
  },
  methods: {

    /**
     * Gets an object with the necessary form fields
     *
     * @param {string} id
     * @param {string} label
     * @return {object}
     */
    getFieldProps(id, label) {
      return {
        id,
        label,
        errorMessage: this.validationErrors[id],
      };
    },

    async onSubmit() {
      this.loading = true;
      this.serverError = false;
      this.validationErrors = this.getEmptyValidationErrors();

      try {
        const response = await saveMember({
          ...this.form,

        });

        // await clearCart();

        // window.location = `/confirmation/${response.data.id}`;
         window.location = `https://docs.igle.ar/member/${response.data.id}`;

      } catch (error) {
        const {response} = error;

        if (response.status !== 400) {
          this.serverError = true;
        } else {
          response.data.violations.forEach((violation) => {
            this.validationErrors[violation.propertyPath] = violation.message;
          });
        }
      } finally {
        this.loading = false;
      }
    },
    validateField(event) {
      const validationMessages = {
        firstName: 'Por favor ingrese su nombre',
        lastName: 'Por favor ingrese su apellido',
      };

      const validationField = event.target.id;

      if (!this.form[validationField]) {
        this.validationErrors[validationField] = validationMessages[validationField];
      } else {
        this.validationErrors[validationField] = null;
      }
    },
    getEmptyValidationErrors() {
      return {
        firstName: null,
        lastName: null,
        dateOfBirthAt: null,
      };
    },
  },
  async created() {
    this.situation = (await fetchRelationalSituation()).data['hydra:member'];
    console.log(this.situation)
  },
};
</script>

<style scss>
@import 'vue-date-pick/src/vueDatePick.scss';
</style>
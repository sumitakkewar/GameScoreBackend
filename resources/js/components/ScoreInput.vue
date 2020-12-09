<template>
  <div class="card">
    <div class="card-header">Update Details Here...</div>

    <div class="card-body">
      <form @submit.prevent="onSubmit">
        <div
          class="form-group row"
          v-for="(input, inputIndex) in inputs"
          :key="inputIndex"
        >
          <label for="age" class="col-md-4 col-form-label text-md-right">{{
            input.name
          }}</label>
          <div class="col-md-6">
            <input
              :name="input.name"
              :data-index="inputIndex"
              :type="input.type"
              :class="[{ 'is-invalid': input.error !== null }, 'form-control']"
              @input="input.validation"
              v-model="input.value"
              autofocus
            />
            <span class="invalid-feedback" role="alert">
              <strong>{{ input.error }}</strong>
            </span>
          </div>
        </div>

        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "ScoreInput",
  data() {
    return {
      inputs: [
        {
          name: "Age",
          type: "text",
          validation: this.isInt,
          error: null,
          value: "",
          param_name: "age",
        },
        {
          name: "Duos Mode Lifetime Point",
          type: "text",
          validation: this.isFloat,
          error: null,
          value: "",
          param_name: "duos_point",
        },
        {
          name: "Duos Mode Lifetime Kills",
          type: "text",
          validation: this.isInt,
          error: null,
          value: "",
          param_name: "duos_kills",
        },
        {
          name: "Duos Mode Lifetime Wins",
          type: "text",
          validation: this.isInt,
          error: null,
          value: "",
          param_name: "duos_wins",
        },
        {
          name: "Solor Mode Lifetime Point",
          type: "text",
          validation: this.isFloat,
          error: null,
          value: "",
          param_name: "solo_pont",
        },
        {
          name: "Solor Mode Lifetime Kills",
          type: "text",
          validation: this.isInt,
          error: null,
          value: "",
          param_name: "solo_kills",
        },
        {
          name: "Solor Mode Lifetime Wins",
          type: "text",
          validation: this.isInt,
          error: null,
          value: "",
          param_name: "solo_wins",
        },
      ],
    };
  },
  methods: {
    isInt(n) {
      if (!Number.isInteger(Number(n.target.value))) {
        this.inputs[n.target.dataset["index"]].error = "Interger is required";
      } else {
        this.inputs[n.target.dataset["index"]].error = null;
      }
    },
    isFloat(n) {
      if (Number.isInteger(Number(n.target.value))) {
        this.inputs[n.target.dataset["index"]].error = "Float is required";
      } else {
        this.inputs[n.target.dataset["index"]].error = null;
      }
    },
    onSubmit() {
      let error = this.inputs.filter(
        (input) => input.value.trim() === "" || input.error !== null
      );
      if (error.length > 0) {
        error.forEach((input) => {
          if (input.error !== null) {
            input.error = `The ${input.name} field Required`;
          }
        });
      } else {
        let myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        let requestParams = {
          userid: this.$userId,
        };

        this.inputs.forEach((input) => {
          requestParams[input.param_name] = input.value;
        });

        let raw = JSON.stringify(requestParams);

        let requestOptions = {
          method: "POST",
          headers: myHeaders,
          body: raw,
          redirect: "follow",
        };

        fetch(process.env.MIX_API_BASE_URL + "/users", requestOptions)
          .then((response) => response.text())
          .then((result) => {
            this.inputs.forEach((input) => {
              input.value = "";
            });
          })
          .catch((error) => console.log("error", error));
      }
    },
  },
};
</script>

import { extend } from "vee-validate";
import { required, email } from "vee-validate/dist/rules";

extend("min", value => {
    return value.length >= 3;
});

extend("email", email);

extend("required", {
    ...required,
    message: "This field is required"
});

import React, {useState} from 'react';
import {httpConfig} from "../../../utils/http-config";
import * as Yup from "yup";
import {Formik} from "formik";

import {SignUpFormContent} from "./SignUpFormContent";
import {useHistory} from "react-router";

export const SignUpForm = () => {
	// const history = useHistory()
	const signUp = {
		userEmail: "",
		userName: "",
		userPassword: "",
		userPasswordConfirm: "",
	};

	const [status, setStatus] = useState(null);
	const validator = Yup.object().shape({
		userAvatarUrl: Yup.string()
			.required('User Avatar URL required for sign-up'),
		userEmail: Yup.string()
			.email("email must be a valid email")
			.required('email is required'),
		userName: Yup.string()
			.required("Name is required"),
		userPassword: Yup.string()
			.required("Password is required")
			.min(8, "Password must be at least eight characters"),
		userPasswordConfirm: Yup.string()
			.required("Password Confirm is required")
			.min(8, "Password must be at least eight characters"),
	});

	const submitSignUp = (values, {resetForm}) => {
		httpConfig.post("/apis/sign-up/", values)
			.then(reply => {
					let {message, type} = reply;
					setStatus({message, type});
					if(reply.status === 200) {
						resetForm();
					}
				}
			);
	};


	return (

		<Formik
			initialValues={signUp}
			onSubmit={submitSignUp}
			validationSchema={validator}
		>
			{SignUpFormContent}
		</Formik>

	)
};
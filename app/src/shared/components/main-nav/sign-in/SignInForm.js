import React, {useState} from 'react';
import {Redirect} from "react-router";
import {httpConfig} from "../../../utils/http-config";
import {Formik} from "formik/dist/index";
import * as Yup from "yup";
import {useHistory} from "react-router";


import {SignInFormContent} from "./SignInFormContent";



export const SignInForm = ({handleClose}) => {

	const signIn = {
		userEmail: "",
		userPassword: ""
	};

	// state variable to handle redirect to posts page on sign in
	const history = useHistory();

	const validator = Yup.object().shape({
		userEmail: Yup.string()
			.email("email must be a valid email")
			.required('email is required'),
		userPassword: Yup.string()
			.required("Password is required")
	});

	const submitSignIn = (values, {resetForm, setStatus}) => {
		httpConfig.post("/apis/sign-in/", values)
			.then(reply => {
				let {message, type} = reply;
				setStatus({message, type});
				if(reply.status === 200 && reply.headers["x-jwt-token"]) {
					window.localStorage.removeItem("jwt-token");
					window.localStorage.setItem("jwt-token", reply.headers["x-jwt-token"]);
					resetForm();
					// handleClose();
					// window.location.reload();
					history.push("/UserPage")
					setTimeout(() => {
						//setToPosts(true);
						// window.location = "UserPage";
					}, 750);
					}
				setStatus({message, type});
			});
	};

	return (
		<>
			{/* redirect user to userPage page on sign in */}
			{/*{UserPage? <Redirect to="/user" /> : null}*/}

			<Formik
				initialValues={signIn}
				onSubmit={submitSignIn}
				validationSchema={validator}
			>
				{SignInFormContent}
			</Formik>
		</>
	)
};

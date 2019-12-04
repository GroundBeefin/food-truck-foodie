import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {FormDebugger} from "../../FormDebugger";
import React from "react";

export const SignUpFormContent = (props) => {
	const {
		submitStatus,
		values,
		errors,
		touched,
		dirty,
		isSubmitting,
		handleChange,
		handleBlur,
		handleSubmit,
		handleReset
	} = props;
	return (
		<>
			<form onSubmit={handleSubmit}>
				{/*controlId must match what is passed to the initialValues prop*/}
				<div className="form-group">
					<label htmlFor="userEmail">Email Address</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="envelope"/>
							</div>
						</div>
						<input
							className="form-control"
							id="userEmail"
							type="email"
							value={values.userEmail}
							placeholder="Enter email"
							onChange={handleChange}
							onBlur={handleBlur}

						/>
					</div>
					{
						errors.userEmail && touched.userEmail && (
							<div className="alert alert-danger">
								{errors.userEmail}
							</div>
						)

					}
				</div>
				{/*controlId must match what is defined by the initialValues object*/}
				<div className="form-group">
					<label htmlFor="userPassword">Password</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="key"/>
							</div>
						</div>
						<input
							id="userPassword"
							className="form-control"
							type="password"
							placeholder="Password"
							value={values.userPassword}
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{errors.userPassword && touched.userPassword && (
						<div className="alert alert-danger">{errors.userPassword}</div>
					)}
				</div>
				<div className="form-group">
					<label htmlFor="userPasswordConfirm">Confirm Your Password</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="key"/>
							</div>
						</div>
						<input

							className="form-control"
							type="password"
							id="userPasswordConfirm"
							placeholder="Password Confirm"
							value={values.userPasswordConfirm}
							onChange={handleChange}
							onBlur={handleBlur}
						/>
					</div>
					{errors.userPasswordConfirm && touched.userPasswordConfirm && (
						<div className="alert alert-danger">{errors.userPasswordConfirm}</div>
					)}
				</div>


				{/*<div className="form-group">*/}
				{/*	<label htmlFor="userHandle">@Handle</label>*/}
				{/*	<div className="input-group">*/}
				{/*		<div className="input-group-prepend">*/}
				{/*			<div className="input-group-text">*/}
				{/*				<FontAwesomeIcon icon="dove"/>*/}
				{/*			</div>*/}
				{/*		</div>*/}
				{/*		<input*/}
				{/*			className="form-control"*/}
				{/*			id="profileHandle"*/}
				{/*			type="text"*/}
				{/*			value={values.profileAtHandle}*/}
				{/*			placeholder="@Handle"*/}
				{/*			onChange={handleChange}*/}
				{/*			onBlur={handleBlur}*/}

				{/*		/>*/}
				{/*	</div>*/}
				{/*	{*/}
				{/*		errors.profileAtHandle && touched.profileAtHandle && (*/}
				{/*			<div className="alert alert-danger">*/}
				{/*				{errors.profileAtHandle}*/}
				{/*			</div>*/}
				{/*		)*/}
				{/*	}*/}
				{/*</div>*/}


				{/*<div className="form-group">*/}
				{/*	<label htmlFor="profilePhone">Phone Number</label>*/}
				{/*	<div className="input-group">*/}
				{/*		<div className="input-group-prepend">*/}
				{/*			<div className="input-group-text">*/}
				{/*				<FontAwesomeIcon icon="phone"/>*/}
				{/*			</div>*/}
				{/*		</div>*/}
				{/*		<input*/}
				{/*			className="form-control"*/}
				{/*			id="profilePhone"*/}
				{/*			type="text"*/}
				{/*			value={values.profilePhone}*/}
				{/*			placeholder="Enter email"*/}
				{/*			onChange={handleChange}*/}
				{/*			onBlur={handleBlur}*/}
				{/*		/>*/}
				{/*	</div>*/}
				{/*	{*/}
				{/*		errors.profilePhone && touched.profilePhone && (*/}
				{/*			<div className="alert alert-danger">*/}
				{/*				{errors.profilePhone}*/}
				{/*			</div>*/}
				{/*		)*/}

				{/*	}*/}
				{/*</div>*/}
				<div className="form-group">
					<button className="btn btn-primary mb-2" type="submit">Submit</button>
					<button
						className="btn btn-danger mb-2"
						onClick={handleReset}
						disabled={!dirty || isSubmitting}
					>Reset
					</button>
				</div>


				<FormDebugger {...props} />
			</form>
			{console.log(
				submitStatus
			)}
			{
				submitStatus && (<div className={submitStatus.type}>{submitStatus.message}</div>)
			}
		</>


	)
};
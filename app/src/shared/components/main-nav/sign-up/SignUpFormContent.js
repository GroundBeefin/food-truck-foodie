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

					<div className="form-group">
						<label htmlFor="userAvatarUrl">Avatar</label>
						<div className="input-group">

							<input
								className="form-control"
								id="userAvatarUrl"
								type="text"
								value={values.userAvatarUrl}
								placeholder="Avatar Url"
								onChange={handleChange}
								onBlur={handleBlur}

							/>
						</div>
						{
							errors.userAvatarUrl && touched.userAvatarUrl && (
								<div className="alert alert-danger">
									{errors.userAvatarUrl}
								</div>
							)
						}
					</div>


					<div className="form-group">
						<label htmlFor="userName">Name</label>
						<div className="input-group">

							<input
								className="form-control"
								id="userName"
								type="text"
								value={values.userName}
								placeholder="Name"
								onChange={handleChange}
								onBlur={handleBlur}

							/>
						</div>
						{
							errors.userName && touched.userName && (
								<div className="alert alert-danger">
									{errors.userName}
								</div>
							)
						}
					</div>



				</div>
				{/*controlId must match what is defined by the initialValues object*/}
				<div className="form-group">
					<label htmlFor="userPassword">Password</label>
					<div className="input-group">

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
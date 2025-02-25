import React from 'react';
import {
  Edit,
  SimpleForm,
  TextInput,
} from 'react-admin';


const UserTitle = ({ record }) => {
  return <span>Post {record ? `"${record.title}"` : ''}</span>;
};


const UserEdit = props => (
  <Edit title={<UserTitle />} {...props}>
    <SimpleForm>
      <TextInput source="lastname" />
      <TextInput source="firstname" />
      <TextInput source="type" />
      <TextInput source="username" />
      <TextInput source="email" />
      <TextInput source="address.street" />
      <TextInput source="phone" />
      <TextInput source="company.name" />
    </SimpleForm>
  </Edit>
);

export default UserEdit;

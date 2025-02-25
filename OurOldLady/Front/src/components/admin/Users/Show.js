import React from 'react';
import {
  Show,
  SimpleShowLayout,
  TextField,
  EmailField,
} from 'react-admin';

const UserTitle = ({ record }) => {
  return <span>Post {record ? `"${record.title}"` : ''}</span>;
};


const UserShow = props => (
  <Show {...props}>
    <SimpleShowLayout>      
      <TextField source="id" />
      <TextField source="lastname" />
      <TextField source="firstname" />
      <TextField source="type" />
      <TextField source="username" />
      <EmailField source="email" />
    </SimpleShowLayout>
  </Show>
);

export default UserShow;

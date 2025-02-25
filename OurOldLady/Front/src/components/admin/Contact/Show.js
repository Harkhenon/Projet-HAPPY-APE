import React from 'react';
import {
  Show,
  SimpleShowLayout,
  TextField,
  RichTextField,
  DateField,
  EmailField,
} from 'react-admin';

const ContactShow = props => (
  <Show {...props}>
    <SimpleShowLayout>      
      <TextField source="lastname" />
      <TextField source="firstname" />
      <EmailField source="email" />
      <TextField source="message" />      
    </SimpleShowLayout>
  </Show>
);

export default ContactShow;

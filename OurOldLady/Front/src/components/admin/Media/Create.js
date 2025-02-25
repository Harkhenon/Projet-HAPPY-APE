import React from 'react';
import {
  Create,
  SimpleForm,
  ReferenceInput,
  TextInput,
  SelectInput,
  ImageInput,
  ImageField,
  DateInput,

} from 'react-admin';

import RichTextInput from 'ra-input-rich-text';


const MediaCreate = props => (
  <Create {...props}>
    <SimpleForm>
      <TextInput source="title" />
      <TextInput source="url" />
      <TextInput source="type" />
    </SimpleForm>
  </Create>
);

export default MediaCreate;

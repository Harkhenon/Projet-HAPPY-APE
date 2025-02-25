import React from 'react';
import {
  Show,
  SimpleShowLayout,
  TextField,
  RichTextField,
  DateField,
} from 'react-admin';

const PrivatePostTitle = ({ record }) => {
  return <span>Post {record ? `"${record.title}"` : ''}</span>;
};


const PrivatePostShow = props => (
  <Show {...props}>
    <SimpleShowLayout>      
      <TextField source="title" />
      <RichTextField source="content" />
      <DateField label="Publication date" source="created_at" />
    </SimpleShowLayout>
  </Show>
);

export default PrivatePostShow;

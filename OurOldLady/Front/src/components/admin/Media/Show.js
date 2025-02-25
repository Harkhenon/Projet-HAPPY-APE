import React from 'react';
import {
  Show,
  SimpleShowLayout,
  TextField,
  RichTextField,
  DateField,
} from 'react-admin';

const MediaTitle = ({ record }) => {
  return <span>Post {record ? `"${record.title}"` : ''}</span>;
};


const MediaShow = props => (
  <Show {...props}>
    <SimpleShowLayout>      
      <TextField source="title" />
      <TextField source="url" />
    </SimpleShowLayout>
  </Show>
);

export default MediaShow;

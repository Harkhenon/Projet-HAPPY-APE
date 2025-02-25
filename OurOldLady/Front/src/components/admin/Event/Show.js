import React from 'react';
import {
  Show,
  SimpleShowLayout,
  TextField,
  RichTextField,
  DateField,
} from 'react-admin';

const EventShow = props => (
  <Show {...props}>
    <SimpleShowLayout>      
      <TextField source="title" />
      <RichTextField source="content" />
      <DateField label="Publication date" source="created_at" />
    </SimpleShowLayout>
  </Show>
);

export default EventShow;
